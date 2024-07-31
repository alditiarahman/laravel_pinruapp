<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangRusak;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Storage;

class BarangRusakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangrusak = BarangRusak::with('ruangan')->paginate(10);
        return view('barangrusak.index', compact('barangrusak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        return view('barangrusak.create', compact('ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'nama_barang' => 'required',
            'foto_barang' => 'required',
        ]);

        // Upload image
        $image = $request->file('foto_barang');
        $image->storeAs('public/barangrusak', $image->hashName());

        $barangrusak = new BarangRusak();
        $barangrusak->id_ruangan = $request->id_ruangan;
        $barangrusak->nama_barang = $request->nama_barang;
        $barangrusak->foto_barang = $image->hashName();

        if ($barangrusak->save()) {
            return redirect()->route('barangrusak.index')->with('success', 'Barang Rusak created successfully.');
        } else {
            return redirect()->route('barangrusak.index')->with('error', 'Failed to create Barang Rusak.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barangrusak = BarangRusak::with('ruangan')->findorFail($id);
        $ruangans = Ruangan::all();
        return view('barangrusak.show', compact('barangrusak', 'ruangans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangans = Ruangan::orderBy('id', 'asc')->get();
        $barangrusak = BarangRusak::with('ruangan')->find($id);
        return view('barangrusak.edit', compact('ruangans', 'barangrusak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barangrusak = BarangRusak::find($id);

        $request->validate([
            'id_ruangan' => 'required',
            'nama_barang' => 'required',
        ]);

        if ($request->hasFile('foto_barang')) {
            // Delete old image
            Storage::disk('public')->delete('barangrusak/' . basename($barangrusak->foto_barang));

            // Upload new image
            $image = $request->file('foto_barang');
            $image->storeAs('public/barangrusak', $image->hashName());
            $barangrusak->foto_barang = $image->hashName();
        }

        $barangrusak->id_ruangan = $request->id_ruangan;
        $barangrusak->nama_barang = $request->nama_barang;

        // Save the updated data
        if ($barangrusak->save()) {
            return redirect()->route('barangrusak.index')->with('success', 'Data barang rusak berhasil diubah');
        } else {
            return redirect()->route('barangrusak.index')->with('error', 'Data barang rusak gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangrusak = BarangRusak::findOrFail($id);

        // Delete image
        Storage::disk('public')->delete('barangrusak/' . $barangrusak->foto_barang);

        // Delete the Barang Rusak instance
        if ($barangrusak->delete()) {
            return redirect()->route('barangrusak.index')->with('success', 'Data barang rusak berhasil dihapus');
        } else {
            return redirect()->route('barangrusak.index')->with('error', 'Data barang rusak gagal dihapus');
        }
    }
}
