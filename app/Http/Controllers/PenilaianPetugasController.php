<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenilaianPetugas;
use App\Models\User;

class PenilaianPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaianpetugas = null;
        if (Auth::user()->hasRole('peminjam') || Auth::user()->hasRole('admin')) {
            $penilaianpetugas = PenilaianPetugas::with('petugas:id,name')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('penilaianpetugas.index', compact('penilaianpetugas'));
    }

    public function nomor_surat()
    {
        $increment = PenilaianPetugas::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/BAWASLU-PP/%s/%d', $increment, $bulan_romawi, $tahun);
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
        $users = User::all();
        return view('penilaianpetugas.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_petugas' => 'required',
            'pelayanan' => 'required',
            'saran' => 'nullable',
        ]);

        try {
            $penilaianpetugas = new PenilaianPetugas();
            $penilaianpetugas->nomor_surat = $this->nomor_surat();
            $penilaianpetugas->id_petugas = $request->id_petugas;
            $penilaianpetugas->pelayanan = $request->pelayanan;
            $penilaianpetugas->saran = $request->saran;
            $penilaianpetugas->save();

            return redirect()->route('penilaianpetugas.index')->with('success', 'Penilaian petugas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('penilaianpetugas.index')->with('error', 'Penilaian petugas gagal ditambahkan');
        }
    }

    // Implement methods if needed or remove them if not used.
    public function show($id)
    {
        // Retrieve the PenilaianPetugas record by ID
        $penilaianpetugas = PenilaianPetugas::findOrFail($id);
        $user = User::all();

        // Pass the record to the view
        return view('penilaianpetugas.show', compact('penilaianpetugas'));
    }


    public function edit($id)
    {
        // Retrieve the PenilaianPetugas record by ID
        $penilaianpetugas = PenilaianPetugas::findOrFail($id);
        $users = User::all();

        // Pass both penilaianpetugas and users to the view
        return view('penilaianpetugas.edit', compact('penilaianpetugas', 'users'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_petugas' => 'required',
            'pelayanan' => 'required',
            'saran' => 'nullable',
        ]);

        try {
            // Find the PenilaianPetugas record by ID
            $penilaianpetugas = PenilaianPetugas::findOrFail($id);
            $penilaianpetugas->id_petugas = Auth::user()->id;
            $penilaianpetugas->nomor_surat = $this->nomor_surat();
            $penilaianpetugas->pelayanan = $request->pelayanan;
            $penilaianpetugas->saran = $request->saran;
            $penilaianpetugas->save();

            return redirect()->route('penilaianpetugas.index')->with('success', 'Penilaian petugas berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('penilaianpetugas.index')->with('error', 'Penilaian petugas gagal diperbarui');
        }
    }


    public function destroy(string $id)
    {
        $penilaianpetugas = PenilaianPetugas::findOrFail($id);
        if ($penilaianpetugas->delete()) {
            return redirect()->route('penilaianpetugas.index')->with('success', 'Data penilaian petugas berhasil dihapus');
        } else {
            return redirect()->route('penilaianpetugas.index')->with('error', 'Data penilaian petugas gagal dihapus');
        }
    }
}
