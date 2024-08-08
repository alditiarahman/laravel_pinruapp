<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Ruangan;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenance = Maintenance::with('ruangan')->paginate(10);
        return view('maintenances.index', compact('maintenance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        return view('maintenances.create', compact('ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'tanggal_maintenance' => 'required',
            'status' => 'required',
        ]);

        $maintenance = new Maintenance();
        $maintenance->id_ruangan = $request->id_ruangan;
        $maintenance->tanggal_maintenance = $request->tanggal_maintenance;
        $maintenance->status = $request->status;
        if ($maintenance->save()) {
            return redirect()->route('maintenances.index')->with('success', 'Maintenance created successfully.');
        } else {
            return redirect()->route('maintenances.index')->with('error', 'Failed to create Maintenance.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maintenance = Maintenance::with('ruangan')->findOrFail($id);
        $ruangans = Ruangan::all();
        return view('maintenances.show', compact('maintenance', 'ruangans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangans = Ruangan::orderBy('id', 'asc')->get();
        $maintenance = Maintenance::with('ruangan')->find($id);
        return view('maintenances.edit', compact('ruangans', 'maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $maintenance = Maintenance::find($id);

        $request->validate([
            'id_ruangan' => 'required',
            'tanggal_maintenance' => 'required',
            'status' => 'required',
        ]);

        $maintenance->id_ruangan = $request->id_ruangan;
        $maintenance->tanggal_maintenance = $request->tanggal_maintenance;
        $maintenance->status = $request->status;
        if ($maintenance->save()) {
            return redirect()->route('maintenances.index')->with('success', 'Maintenance updated successfully.');
        } else {
            return redirect()->route('maintenances.index')->with('error', 'Failed to update Maintenance.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maintenance = Maintenance::findorFail($id);
        if ($maintenance->delete()) {
            return redirect()->route('maintenances.index')->with('success', 'Maintenance deleted successfully.');
        } else {
            return redirect()->route('maintenances.index')->with('error', 'Failed to delete Maintenance.');
        }
    }
}
