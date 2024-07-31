<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangans = Ruangan::paginate(10);
        return view('ruangans.index', compact('ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
        ]);

        $ruangans = new Ruangan();
        $ruangans->nama_ruangan = $request->nama_ruangan;
        $ruangans->kapasitas = $request->kapasitas;
        $ruangans->fasilitas = $request->fasilitas;

        if ($ruangans->save()) {
            return redirect()->route('ruangans.index')->with('success', 'Ruangan created successfully.');
        } else {
            return redirect()->route('ruangans.index')->with('error', 'Failed to create ruangan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruangans = Ruangan::find($id);
        return view('ruangans.show', compact('ruangans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangans = Ruangan::findOrFail($id);
        return view('ruangans.edit', compact('ruangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruangans = Ruangan::findOrFail($id);

        $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
        ]);

        $ruangans->nama_ruangan = $request->nama_ruangan;
        $ruangans->kapasitas = $request->kapasitas;
        $ruangans->fasilitas = $request->fasilitas;

        if ($ruangans->save()) {
            return redirect()->route('ruangans.index')->with('success', 'Ruangan updated successfully.');
        } else {
            return redirect()->route('ruangans.index')->with('error', 'Failed to update ruangan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruangans = Ruangan::findOrFail($id);
        if ($ruangans->delete()) {
            return redirect()->route('ruangans.index')->with('success', 'Ruangan deleted successfully.');
        } else {
            return redirect()->route('ruangans.index')->with('error', 'Failed to delete ruangan.');
        }
    }
}
