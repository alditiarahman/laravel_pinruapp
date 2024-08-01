<?php

namespace App\Http\Controllers;

use App\Models\Pembatalan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembatalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator')) {
            $pembatalan = Pembatalan::with('peminjaman')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $pembatalan = Pembatalan::with(['peminjaman', 'peminjam'])
                ->where('id_peminjam', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('pembatalans.index', compact('pembatalan'));
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

        return view('pembatalans.create', compact('peminjamans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'tanggal_pembatalan' => 'required',
            'alasan_pembatalan' => 'required',
        ]);

        $pembatalan = new Pembatalan();
        $pembatalan->id_peminjaman = $request->id_peminjaman;
        $pembatalan->id_peminjam = Auth::user()->id;
        $pembatalan->tanggal_pembatalan = $request->tanggal_pembatalan;
        $pembatalan->alasan_pembatalan = $request->alasan_pembatalan;

        if ($pembatalan->save()) {
            return redirect()->route('pembatalans.index')->with('success', 'Pembatalan berhasil ditambahkan');
        } else {
            return redirect()->route('pembatalans.index')->with('error', 'Pembatalan gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data pembatalan berdasarkan ID
        $pembatalan = Pembatalan::with(['peminjaman.ruangan', 'peminjaman.peminjam', 'peminjaman.petugas'])
            ->findOrFail($id);

        // Jika Anda ingin menampilkan informasi terkait peminjaman untuk pilihan (seperti dropdown), tambahkan:
        $userId = Auth::user()->id;
        $peminjamans = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])
            ->where('id_peminjam', $userId)
            ->get();

        // Mengembalikan tampilan dengan data pembatalan dan peminjaman
        return view('pembatalans.show', compact('pembatalan', 'peminjamans'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $userId = Auth::user()->id;

        // Ambil data peminjaman yang relevan untuk user
        $peminjamans = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])
            ->where('id_peminjam', $userId)
            ->get();

        // Ambil data pembatalan berdasarkan ID
        $pembatalan = Pembatalan::with(['peminjaman.ruangan', 'peminjaman.peminjam', 'peminjaman.petugas'])
            ->findOrFail($id);

        if ($request->ajax()) {
            return response()->json($pembatalan);
        }

        return view('pembatalans.edit', compact('peminjamans', 'pembatalan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'tanggal_pembatalan' => 'required',
            'alasan_pembatalan' => 'required',
        ]);

        // Ambil data pembatalan berdasarkan ID
        $pembatalan = Pembatalan::findOrFail($id);

        // Update data pembatalan dengan data dari request
        $pembatalan->id_peminjaman = $request->id_peminjaman;
        $pembatalan->tanggal_pembatalan = $request->tanggal_pembatalan;
        $pembatalan->alasan_pembatalan = $request->alasan_pembatalan;

        // Simpan perubahan
        if ($pembatalan->save()) {
            return redirect()->route('pembatalans.index')->with('success', 'Pembatalan berhasil diperbarui');
        } else {
            return redirect()->route('pembatalans.index')->with('error', 'Pembatalan gagal diperbarui');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembatalan = Pembatalan::findOrFail($id);
        if ($pembatalan->delete()) {
            return redirect()->route('pembatalans.index')->with('success', 'Pembatalan deleted successfully.');
        } else {
            return redirect()->route('pembatalans.index')->with('error', 'Failed to delete pembatalan.');
        }
    }
}
