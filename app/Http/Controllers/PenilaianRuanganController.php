<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianRuangan;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;

class PenilaianRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('peminjam') || Auth::user()->hasRole('admin')) {
            $penilaianruangan = PenilaianRuangan::with('ruangan')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $penilaianruangan = PenilaianRuangan::with('user')
                ->where('id_peminjam', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('penilaianruangans.index', compact('penilaianruangan'));
    }

    public function nomor_surat()
    {
        $increment = PenilaianRuangan::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/BAWASLU-BR/%s/%d', $increment, $bulan_romawi, $tahun);
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
        $userId = Auth::user()->id;
        $ruangans = Ruangan::orderBy('id', 'asc')->get();
        return view('penilaianruangans.create', compact('ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'kebersihan' => 'required',
            'kenyamanan' => 'required',
            'kelengkapan_fasilitas' => 'required',
            'saran' => 'nullable',
        ]);

        try {
            $penilaianruangan = new PenilaianRuangan();
            $penilaianruangan->id_ruangan = $request->id_ruangan;
            $penilaianruangan->id_peminjam = Auth::user()->id;
            $penilaianruangan->nomor_surat = $this->nomor_surat();
            $penilaianruangan->kebersihan = $request->kebersihan;
            $penilaianruangan->kenyamanan = $request->kenyamanan;
            $penilaianruangan->kelengkapan_fasilitas = $request->kelengkapan_fasilitas;
            $penilaianruangan->saran = $request->saran;
            $penilaianruangan->save();

            return redirect()->route('penilaianruangans.index')->with('success', 'Penilaian Ruangan created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('penilaianruangans.index')->with('error', 'Failed to create penilaian ruangan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penilaianruangan = PenilaianRuangan::with('ruangan')->find($id);
        return view('penilaianruangans.show', compact('penilaianruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penilaianruangan = PenilaianRuangan::with('ruangan')->find($id);
        $ruangans = Ruangan::orderBy('id', 'asc')->get();
        return view('penilaianruangans.edit', compact('penilaianruangan', 'ruangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'kebersihan' => 'required',
            'kenyamanan' => 'required',
            'kelengkapan_fasilitas' => 'required',
            'saran' => 'nullable',
        ]);

        try {
            $penilaianruangan = PenilaianRuangan::find($id);
            $penilaianruangan->id_ruangan = $request->id_ruangan;
            $penilaianruangan->id_peminjam = Auth::user()->id;
            $penilaianruangan->nomor_surat = $this->nomor_surat();
            $penilaianruangan->kebersihan = $request->kebersihan;
            $penilaianruangan->kenyamanan = $request->kenyamanan;
            $penilaianruangan->kelengkapan_fasilitas = $request->kelengkapan_fasilitas;
            $penilaianruangan->saran = $request->saran;
            $penilaianruangan->save();

            return redirect()->route('penilaianruangans.index')->with('success', 'Penilaian Ruangan updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('penilaianruangans.index')->with('error', 'Failed to update penilaian ruangan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $penilaianruangan = PenilaianRuangan::find($id);
            $penilaianruangan->delete();
            return redirect()->route('penilaianruangans.index')->with('success', 'Penilaian Ruangan deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('penilaianruangans.index')->with('error', 'Failed to delete penilaian ruangan: ' . $e->getMessage());
        }
    }
}
