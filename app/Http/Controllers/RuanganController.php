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
        $data = $request->validate([
            'nama_ruangan' => 'required|string',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        // Combine fasilitas and jumlah into a JSON array or any other structure as needed
        $ruangan = new Ruangan();
        $ruangan->nama_ruangan = $data['nama_ruangan'];
        $ruangan->kapasitas = $data['kapasitas'];
        $ruangan->fasilitas = json_encode(array_map(null, $data['fasilitas'], $data['jumlah']));
        $ruangan->save();

        return redirect()->route('ruangans.index')->with('success', 'Data Ruangan berhasil disimpan');
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
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_ruangan' => 'required|string',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        // Find the existing ruangan by ID
        $ruangan = Ruangan::findOrFail($id);

        // Update the fields with validated data
        $ruangan->nama_ruangan = $data['nama_ruangan'];
        $ruangan->kapasitas = $data['kapasitas'];
        $ruangan->fasilitas = json_encode(array_map(null, $data['fasilitas'], $data['jumlah']));
        $ruangan->save();

        return redirect()->route('ruangans.index')->with('success', 'Data Ruangan berhasil diperbarui');
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
