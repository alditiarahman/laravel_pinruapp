<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator')) {
            $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])
                ->where('id_peminjam', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        $user = User::all();
        return view('peminjamans.index', compact('peminjaman', 'user'));
    }

    public function nomor_surat()
    {
        $increment = Peminjaman::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/BAWASLU-PMJ/%s/%d', $increment, $bulan_romawi, $tahun);
        return $nomor;
    }

    /**
     * Convert number to roman
     */
    private function convertToRoman($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        return view('peminjamans.create', compact('ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'nama_pj' => 'required',
            'jabatan' => 'required',
            'instansi' => 'required',
            'nomor_identitas' => 'required',
            'nomor_telepon' => 'required',
            'keperluan' => 'required',
        ]);

        // Check if the room is already booked for the given dates
        $existingBooking = Peminjaman::where('id_ruangan', $request->id_ruangan)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                    });
            })
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['id_ruangan' => 'Ruangan ini sudah dipinjam pada tanggal yang Anda pilih.']);
        }

        $peminjaman = new Peminjaman();
        $peminjaman->id_ruangan = $request->id_ruangan;
        $peminjaman->id_peminjam = auth()->id();
        $peminjaman->nomor_surat = $this->nomor_surat();
        $peminjaman->tanggal_mulai = $request->tanggal_mulai;
        $peminjaman->tanggal_selesai = $request->tanggal_selesai;
        $peminjaman->nama_pj = $request->nama_pj;
        $peminjaman->jabatan = $request->jabatan;
        $peminjaman->instansi = $request->instansi;
        $peminjaman->nomor_identitas = $request->nomor_identitas;
        $peminjaman->nomor_telepon = $request->nomor_telepon;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->jumlah_hari = $peminjaman->calculateJumlahHari();

        if ($peminjaman->save()) {
            return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil diajukan');
        } else {
            return redirect()->route('peminjamans.index')->with('error', 'Peminjaman gagal diajukan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->findOrFail($id);
        return view('peminjamans.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangans = Ruangan::all();
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->findOrFail($id);
        return view('peminjamans.edit', compact('peminjaman', 'ruangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'nama_pj' => 'required',
            'jabatan' => 'required',
            'instansi' => 'required',
            'nomor_identitas' => 'required',
            'nomor_telepon' => 'required',
            'keperluan' => 'required',
        ]);

        // Fetch the existing booking record
        $peminjaman = Peminjaman::findOrFail($id);

        // Check if the room is already booked for the given dates, excluding the current booking
        $existingBooking = Peminjaman::where('id_ruangan', $request->id_ruangan)
            ->where('id', '!=', $id) // Exclude the current booking
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                    });
            })
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['id_ruangan' => 'Ruangan ini sudah dipinjam pada tanggal yang Anda pilih.']);
        }

        // Update the booking details
        $peminjaman->id_ruangan = $request->id_ruangan;
        $peminjaman->id_peminjam = auth()->id();
        $peminjaman->nomor_surat = $this->nomor_surat();
        $peminjaman->tanggal_mulai = $request->tanggal_mulai;
        $peminjaman->tanggal_selesai = $request->tanggal_selesai;
        $peminjaman->nama_pj = $request->nama_pj;
        $peminjaman->jabatan = $request->jabatan;
        $peminjaman->instansi = $request->instansi;
        $peminjaman->nomor_identitas = $request->nomor_identitas;
        $peminjaman->nomor_telepon = $request->nomor_telepon;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->jumlah_hari = $peminjaman->calculateJumlahHari();

        if ($peminjaman->save()) {
            return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil diperbarui');
        } else {
            return redirect()->route('peminjamans.index')->with('error', 'Peminjaman gagal diperbarui');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        Storage::delete('public/peminjamans/' . $peminjaman->surat_pernyataan);
        if ($peminjaman->delete()) {
            return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil dihapus');
        } else {
            return redirect()->route('peminjamans.index')->with('error', 'Peminjaman gagal dihapus');
        }
    }

    public function verify(string $id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->id_petugas = Auth::user()->id;
            $peminjaman->status = 'disetujui';

            if ($peminjaman->save()) {
                return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil diverifikasi');
            } else {
                return redirect()->route('peminjamans.index')->with('error', 'Peminjaman gagal diverifikasi');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('peminjamans.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->id_petugas = auth()->id();
        $peminjaman->status = 'ditolak';
        if ($peminjaman->save()) {
            return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil ditolak');
        } else {
            return redirect()->route('peminjamans.index')->with('error', 'Peminjaman gagal ditolak');
        }
    }
}
