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
        $ruangan = Ruangan::all();
        return view('barangrusak.index', compact('barangrusak', 'ruangan'));
    }

    public function nomor_surat()
    {
        $increment = BarangRusak::count() + 1;
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
        $ruangans = Ruangan::all();
        return view('barangrusak.create', compact('ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_ruangan' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'foto_barang' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Ambil ruangan berdasarkan id_ruangan
        $ruangan = Ruangan::find($request->id_ruangan);
        $fasilitas = json_decode($ruangan->fasilitas, true); // Decode fasilitas JSON

        // Cari fasilitas yang sesuai dengan nama_barang yang diinput
        $fasilitasDitemukan = false;
        foreach ($fasilitas as &$f) {
            if ($f[0] === $request->nama_barang) {
                // Kurangi jumlah fasilitas jika lebih besar dari 0
                if ($f[1] > 0) {
                    $f[1] -= 1;
                    $fasilitasDitemukan = true;
                }
                break;
            }
        }

        // Update fasilitas pada ruangan jika barang ditemukan
        if ($fasilitasDitemukan) {
            $ruangan->fasilitas = json_encode($fasilitas); // Encode fasilitas kembali ke JSON
            $ruangan->save();
        }

        // Simpan data barang rusak
        $barangRusak = new BarangRusak();
        $barangRusak->id_ruangan = $request->id_ruangan;
        $barangRusak->nama_barang = $request->nama_barang;
        $barangRusak->nomor_surat = $this->nomor_surat();
        $barangRusak->foto_barang = $request->file('foto_barang')->store('barang_rusak', 'public'); // Simpan foto
        $barangRusak->save();

        return redirect()->route('barangrusak.index')->with('success', 'Data barang rusak berhasil ditambahkan.');
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
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_ruangan' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Ambil data barang rusak yang ada
        $barangRusak = BarangRusak::findOrFail($id);
        $ruangan = Ruangan::find($request->id_ruangan);
        $fasilitas = json_decode($ruangan->fasilitas, true); // Decode fasilitas JSON

        // Cari fasilitas yang sesuai dengan nama_barang yang diinput
        $fasilitasDitemukan = false;
        foreach ($fasilitas as &$f) {
            if ($f[0] === $request->nama_barang) {
                // Kurangi jumlah fasilitas jika lebih besar dari 0
                if ($f[1] > 0) {
                    $f[1] -= 1;
                    $fasilitasDitemukan = true;
                }
                break;
            }
        }

        // Update fasilitas pada ruangan jika barang ditemukan
        if ($fasilitasDitemukan) {
            $ruangan->fasilitas = json_encode($fasilitas); // Encode fasilitas kembali ke JSON
            $ruangan->save();
        }

        // Update data barang rusak
        $barangRusak->id_ruangan = $request->id_ruangan;
        $barangRusak->nama_barang = $request->nama_barang;
        $barangRusak->nomor_surat = $this->nomor_surat();

        // Jika ada foto baru, simpan dan ganti yang lama
        if ($request->hasFile('foto_barang')) {
            // Hapus foto lama jika ada
            if ($barangRusak->foto_barang) {
                Storage::disk('public')->delete($barangRusak->foto_barang);
            }
            $barangRusak->foto_barang = $request->file('foto_barang')->store('barang_rusak', 'public');
        }

        $barangRusak->save();

        return redirect()->route('barangrusak.index')->with('success', 'Data barang rusak berhasil diperbarui.');
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
