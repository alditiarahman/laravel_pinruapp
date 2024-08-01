<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerubahanJadwal;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PerubahanJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator')) {
            $perubahanjadwal = PerubahanJadwal::with('peminjaman')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $perubahanjadwal = PerubahanJadwal::with(['peminjaman', 'petugas', 'peminjam'])
                ->where('id_peminjam', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('perubahanjadwals.index', compact('perubahanjadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = Auth::user()->id;
        $peminjamans = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id_peminjam', $userId)->get();

        if ($request->ajax()) {
            return response()->json($peminjamans);
        }

        return view('perubahanjadwals.create', compact('peminjamans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'tanggal_perubahan' => 'required',
            'alasan_perubahan' => 'required',
        ]);

        $perubahanjadwal = new PerubahanJadwal();
        $perubahanjadwal->id_peminjaman = $request->id_peminjaman;
        $perubahanjadwal->id_peminjam = Auth::user()->id;
        $perubahanjadwal->tanggal_perubahan = $request->tanggal_perubahan;
        $perubahanjadwal->alasan_perubahan = $request->alasan_perubahan;

        if ($perubahanjadwal->save()) {
            return redirect()->route('perubahanjadwals.index')->with('success', 'Perubahan jadwal berhasil diajukan');
        } else {
            return redirect()->route('perubahanjadwals.index')->with('error', 'Perubahan jadwal gagal diajukan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perubahanjadwal = PerubahanJadwal::with(['peminjaman', 'petugas', 'peminjam'])->findOrFail($id);
        return view('perubahanjadwals.show', compact('perubahanjadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userId = Auth::user()->id;
        $perubahanjadwal = PerubahanJadwal::with(['peminjaman.ruangan', 'peminjaman.peminjam', 'peminjaman.petugas'])
            ->where('id', $id)
            ->where('id_peminjam', $userId)
            ->firstOrFail();

        $peminjamans = Peminjaman::where('id_peminjam', $userId)->get();

        return view('perubahanjadwals.edit', compact('perubahanjadwal', 'peminjamans'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'tanggal_perubahan' => 'required',
            'alasan_perubahan' => 'required',
        ]);

        $perubahanjadwal = PerubahanJadwal::findOrFail($id);
        $perubahanjadwal->id_peminjaman = $request->id_peminjaman;
        $perubahanjadwal->id_peminjam = Auth::user()->id;
        $perubahanjadwal->tanggal_perubahan = $request->tanggal_perubahan;
        $perubahanjadwal->alasan_perubahan = $request->alasan_perubahan;
        $perubahanjadwal->status = 'menunggu';

        if ($perubahanjadwal->save()) {
            return redirect()->route('perubahanjadwals.index')->with('success', 'Perubahan jadwal berhasil diperbarui');
        } else {
            return redirect()->route('perubahanjadwals.index')->with('error', 'Perubahan jadwal gagal diperbarui');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perubahanjadwal = PerubahanJadwal::findOrFail($id);
        if ($perubahanjadwal->delete()) {
            return redirect()->route('perubahanjadwals.index')->with('success', 'Perubahan jadwal berhasil dihapus');
        } else {
            return redirect()->route('perubahanjadwals.index')->with('error', 'Perubahan jadwal gagal dihapus');
        }
    }

    public function verify(string $id)
    {
        try {
            $perubahanjadwal = PerubahanJadwal::findOrFail($id);
            $perubahanjadwal->id_petugas = Auth::user()->id;
            $perubahanjadwal->status = 'disetujui';

            if ($perubahanjadwal->save()) {
                return redirect()->route('perubahanjadwals.index')->with('success', 'Perubahan Jadwal berhasil diverifikasi');
            } else {
                return redirect()->route('perubahanjadwals.index')->with('error', 'Perubahan Jadwal gagal diverifikasi');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('perubahanjadwals.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(string $id)
    {
        $perubahanjadwal = PerubahanJadwal::findOrFail($id);
        $perubahanjadwal->id_petugas = auth()->id();
        $perubahanjadwal->status = 'ditolak';
        if ($perubahanjadwal->save()) {
            return redirect()->route('perubahanjadwals.index')->with('success', 'Perubahan Jadwal berhasil ditolak');
        } else {
            return redirect()->route('perubahanjadwals.index')->with('error', 'Perubahan Jadwal gagal ditolak');
        }
    }
}
