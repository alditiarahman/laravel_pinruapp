<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->paginate(10);
        return view('peminjamans.index', compact('peminjaman'));
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
            'tanggal_pinjam' => 'required',
            'nama_pj' => 'required',
            'jabatan' => 'required',
            'instansi' => 'required',
            'nomor_identitas' => 'required',
            'nomor_telepon' => 'required',
            'keperluan' => 'required',
        ]);

        $peminjaman = new Peminjaman();
        $peminjaman->id_ruangan = $request->id_ruangan;
        $peminjaman->id_peminjam = auth()->id();
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->nama_pj = $request->nama_pj;
        $peminjaman->jabatan = $request->jabatan;
        $peminjaman->instansi = $request->instansi;
        $peminjaman->nomor_identitas = $request->nomor_identitas;
        $peminjaman->nomor_telepon = $request->nomor_telepon;
        $peminjaman->keperluan = $request->keperluan;

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
            'tanggal_pinjam' => 'required',
            'nama_pj' => 'required',
            'jabatan' => 'required',
            'instansi' => 'required',
            'nomor_identitas' => 'required',
            'nomor_telepon' => 'required',
            'keperluan' => 'required',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->id_ruangan = $request->id_ruangan;
        $peminjaman->id_peminjam = auth()->id();
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->nama_pj = $request->nama_pj;
        $peminjaman->jabatan = $request->jabatan;
        $peminjaman->instansi = $request->instansi;
        $peminjaman->nomor_identitas = $request->nomor_identitas;
        $peminjaman->nomor_telepon = $request->nomor_telepon;
        $peminjaman->keperluan = $request->keperluan;

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
