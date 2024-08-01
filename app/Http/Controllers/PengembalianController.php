<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator')) {
            $pengembalian = Pengembalian::with('peminjaman')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $pengembalian = Pengembalian::with(['peminjaman', 'peminjam'])
                ->where('id_peminjam', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('pengembalians.index', compact('pengembalian'));
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

        return view('pengembalians.create', compact('peminjamans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required',
        ]);

        $pengembalian = new Pengembalian();
        $pengembalian->id_peminjaman = $request->id_peminjaman;
        $pengembalian->id_peminjam = Auth::user()->id;
        $pengembalian->tanggal_pengembalian = $request->tanggal_pengembalian;

        if ($pengembalian->save()) {
            return redirect()->route('pengembalians.index')->with('success', 'Pengembalian created successfully.');
        } else {
            return redirect()->route('pengembalians.index')->with('error', 'Failed to create pengembalian.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $userId = Auth::user()->id;

        // Ambil data peminjaman yang relevan untuk user
        $peminjamans = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id_peminjam', $userId)->get();

        // Ambil data pengembalian berdasarkan ID
        $pengembalian = Pengembalian::with(['peminjaman.ruangan', 'peminjaman.peminjam', 'peminjaman.petugas'])->findOrFail($id);

        if ($request->ajax()) {
            return response()->json($pengembalian);
        }

        return view('pengembalians.show', compact('peminjamans', 'pengembalian'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $userId = Auth::user()->id;

        // Ambil data peminjaman yang relevan untuk user
        $peminjamans = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id_peminjam', $userId)->get();

        // Ambil data pengembalian berdasarkan ID
        $pengembalian = Pengembalian::with(['peminjaman.ruangan', 'peminjaman.peminjam', 'peminjaman.petugas'])->findOrFail($id);

        if ($request->ajax()) {
            return response()->json($pengembalian);
        }

        return view('pengembalians.edit', compact('peminjamans', 'pengembalian'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Temukan data pengembalian berdasarkan ID
        $pengembalian = Pengembalian::findOrFail($id);

        // Update data dengan informasi dari request
        $pengembalian->id_peminjaman = $request->id_peminjaman;
        $pengembalian->tanggal_pengembalian = $request->tanggal_pengembalian;

        // Simpan perubahan ke database
        if ($pengembalian->save()) {
            return redirect()->route('pengembalians.index')->with('success', 'Pengembalian updated successfully.');
        } else {
            return redirect()->route('pengembalians.index')->with('error', 'Failed to update pengembalian.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        if ($pengembalian->delete()) {
            return redirect()->route('pengembalians.index')->with('success', 'Pengembalian deleted successfully.');
        } else {
            return redirect()->route('pengembalians.index')->with('error', 'Failed to delete pengembalian.');
        }
    }
}
