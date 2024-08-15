<?php

namespace App\Http\Controllers;

use App\Models\BarangRusak;
use App\Models\Maintenance;
use App\Models\Pembatalan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PenilaianPetugas;
use App\Models\PenilaianRuangan;
use App\Models\PerubahanJadwal;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->get();
        $data = [
            'peminjaman' => $peminjaman,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Riwayat Peminjaman'
        ];

        $report = PDF::loadView('peminjamans.print', $data)->setPaper('A4', 'landscape');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Riwayat Peminjaman ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function cetakStatus(Request $request)
    {
        $selected_status = $request->input('status');

        // Filter pengajuan berdasarkan status yang dipilih
        $peminjaman = Peminjaman::when($selected_status, function ($query, $selected_status) {
            $query->where('status', $selected_status);
        })->orderBy('id', 'desc')->get();

        // Tentukan nama status yang dipilih atau default ke 'semua_status'
        $statusNamae = $selected_status ? $selected_status : 'semua_status';

        // Generate PDF
        $pdf = Pdf::loadView('peminjamans.lapstat', compact('peminjaman', 'selected_status'))
            ->setPaper('A4', 'landscape'); // Set paper size to A4 landscape

        // Buat nama file dengan nama status yang dipilih
        $fileName = 'laporan_peminjaman_' . $statusNamae . '.pdf';

        return $pdf->stream($fileName);
    }

    public function cetakWaktu(Request $request)
    {
        $query = Peminjaman::query();

        // Filter berdasarkan waktu
        if ($request->has('tanggal') && $request->has('periode')) {
            $tanggal = $request->input('tanggal');
            $periode = $request->input('periode');

            $tanggal = \Carbon\Carbon::parse($tanggal);

            switch ($periode) {
                case 'hari':
                    $query->whereDate('tanggal_mulai', $tanggal->format('Y-m-d'))
                    ->whereDate('tanggal_selesai', $tanggal->format('Y-m-d'));
                    break;
                case 'minggu':
                    $startOfWeek = $tanggal->startOfWeek()->format('Y-m-d');
                    $endOfWeek = $tanggal->endOfWeek()->format('Y-m-d');
                    $query->whereBetween('tanggal_mulai', [$startOfWeek, $endOfWeek])
                        ->whereBetween('tanggal_selesai', [$startOfWeek, $endOfWeek]);
                    break;
                case 'bulan':
                    $query->whereMonth('tanggal_mulai', $tanggal->month)
                        ->whereYear('tanggal_mulai', $tanggal->year)
                        ->whereMonth('tanggal_selesai', $tanggal->month)
                        ->whereYear('tanggal_selesai', $tanggal->year);
                    break;
                case 'tahun':
                    $query->whereYear('tanggal_mulai', $tanggal->year)
                        ->whereYear('tanggal_selesai', $tanggal->year);
                    break;
            }
        }

        $peminjaman = $query->orderBy('id', 'desc')->get();
        $peminjam = User::all();

        // Nama file PDF berdasarkan periode
        $fileName = 'laporan_peminjaman_' . $request->input('periode') . '.pdf';

        // Generate PDF
        $pdf = Pdf::loadView('peminjamans.lapwaktu', compact('peminjaman', 'peminjam'))
        ->setPaper('A4', 'landscape'); // Set paper size to A4 landscape

        return $pdf->stream($fileName);
    }

    public function cetakPeminjaman(Request $request)
    {
        // Ambil ID peminjam yang dipilih dari request
        $peminjamId = $request->input('peminjam');

        // Jika peminjamId tidak ada, kembalikan semua peminjaman
        if ($peminjamId) {
            // Ambil data peminjam yang dipilih
            $peminjam = User::find($peminjamId);

            // Pastikan peminjam ditemukan
            if (!$peminjam) {
                return redirect()->back()->withErrors('Peminjam tidak ditemukan.');
            }

            // Ambil data peminjaman berdasarkan peminjam yang dipilih
            $peminjaman = Peminjaman::where('id_peminjam', $peminjamId)->orderBy('id', 'desc')->get();

            // Tentukan nama file berdasarkan nama peminjam
            $fileName = 'laporan_peminjaman_' . $peminjam->name . '.pdf';
        } else {
            // Jika tidak ada peminjam yang dipilih, ambil semua peminjaman
            $peminjaman = Peminjaman::orderBy('id', 'desc')->get();

            // Nama file default jika semua peminjaman dipilih
            $fileName = 'laporan_peminjaman_semua_peminjam.pdf';
        }

        // Load view dengan data yang diperlukan
        $pdf = Pdf::loadView('peminjamans.lappem', compact('peminjaman'))
        ->setPaper('A4', 'landscape'); // Set paper size to A4 landscape

        // Stream PDF ke browser dengan nama file yang sesuai
        return $pdf->stream($fileName);
    }


    public function peminjamanbyid($id)
    {
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id', $id)->first();
        $peminjamandata = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id', $id)->get();
        $data = [
            'peminjaman' => $peminjaman,
            'peminjamandata' => $peminjamandata,
            'tanggal' => date('d F Y'),
        ];
        return view('peminjamans.printbyid', $data);
    }

    public function suratpersetujuanbyid($id)
    {
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id', $id)->first();
        $peminjamandata = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->where('id', $id)->get();
        $data = [
            'peminjaman' => $peminjaman,
            'peminjamandata' => $peminjamandata,
            'tanggal' => date('d F Y'),
        ];
        return view('peminjamans.suratpersetujuanbyid', $data);
    }

    public function pembatalan()
    {
        $pembatalan = Pembatalan::with(['peminjaman', 'peminjam'])->get();
        $data = [
            'pembatalan' => $pembatalan,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Pembatalan'
        ];

        $report = PDF::loadView('pembatalans.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Data Pembatalan ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function pengembalian()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'peminjam'])->get();
        foreach ($pengembalian as $data) {
            $tanggalpinjam = Carbon::parse($data->peminjaman->tanggal_pinjam);
            $tanggalpengembalian = Carbon::parse($data->tanggal_pengembalian);
            $data->jumlah_hari = $tanggalpinjam->diffInDays($tanggalpengembalian);
        }
        $data = [
            'pengembalian' => $pengembalian,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Pengembalian'
        ];

        $report = PDF::loadView('pengembalians.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Data Pengembalian ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function perubahanjadwal()
    {
        $perubahanjadwal = PerubahanJadwal::with(['peminjaman', 'petugas', 'peminjam'])->get();
        $data = [
            'perubahanjadwal' => $perubahanjadwal,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Perubahan Jadwal'
        ];

        $report = PDF::loadView('perubahanjadwals.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Data Perubahan Jadwal ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function penilaianruangan()
    {
        $penilaianruangan = PenilaianRuangan::with(['ruangan', 'peminjam'])->get();
        $data = [
            'penilaianruangan' => $penilaianruangan,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Riwayat Penilaian Ruangan'
        ];

        $report = PDF::loadView('penilaianruangans.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Riwayat Penilaian Ruangan ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function penilaianruanganbyid($id)
    {
        $penilaianruangan = PenilaianRuangan::with(['ruangan', 'peminjam'])->where('id', $id)->first();
        $penilaianruangandata = PenilaianRuangan::with(['ruangan', 'peminjam'])->where('id', $id)->get();
        $data = [
            'penilaianruangan' => $penilaianruangan,
            'penilaianruangandata' => $penilaianruangandata,
            'tanggal' => date('d F Y'),
        ];
        return view('penilaianruangans.printbyid', $data);
    }

    public function cetakHisniruByRuangan(Request $request)
    {
        $penilaianruangan = PenilaianRuangan::orderBy('id', 'desc')->get();
        $ruangan = Ruangan::all();
        $selected_ruangan = $request->input('selected_ruangan');
        $ruanganId = $request->input('ruangan');

        // Filter pengajuan berdasarkan divisi yang dipilih
        $penilaianruangan = PenilaianRuangan::when($ruanganId, function ($query, $ruanganId) {
            $query->whereHas('ruangan', function ($query) use ($ruanganId) {
                $query->where('id', $ruanganId);
            });
        })->orderBy('id', 'desc')->get();

        // Tentukan nama divisi yang dipilih atau default ke 'semua divisi'
        $ruanganName = $ruanganId ? Ruangan::find($ruanganId)->nama_ruangan : 'semua_ruangan';

        // Generate PDF
        $pdf = Pdf::loadView('penilaianruangans.hisniru-ruangan', compact('penilaianruangan', 'ruangan', 'selected_ruangan'))
        ->setPaper('A4', 'landscape'); // Set paper size to A4 landscape

        // Buat nama file dengan nama divisi yang dipilih
        $fileName = 'laporan_penilaianruangan_by_ruangan_' . $ruanganName . '.pdf';

        return $pdf->stream($fileName);
    }

    public function cetakHisniruByPeminjam(Request $request)
    {
        // Ambil ID peminjam yang dipilih dari request
        $peminjamId = $request->input('peminjam');

        // Jika peminjamId tidak ada, kembalikan semua peminjaman
        if ($peminjamId) {
            // Ambil data peminjam yang dipilih
            $peminjam = User::find($peminjamId);

            // Pastikan peminjam ditemukan
            if (!$peminjam) {
                return redirect()->back()->withErrors('Peminjam tidak ditemukan.');
            }

            // Ambil data peminjaman berdasarkan peminjam yang dipilih
            $penilaianruangan = PenilaianRuangan::where('id_peminjam', $peminjamId)->orderBy('id', 'desc')->get();

            // Tentukan nama file berdasarkan nama peminjam
            $fileName = 'laporan_penilaianruangan_by_peminjam_' . $peminjam->name . '.pdf';
        } else {
            // Jika tidak ada peminjam yang dipilih, ambil semua peminjaman
            $penilaianruangan = PenilaianRuangan::orderBy('id', 'desc')->get();

            // Nama file default jika semua peminjaman dipilih
            $fileName = 'laporan_penilaian_ruangan_semua_peminjam.pdf';
        }

        // Load view dengan data yang diperlukan
        $pdf = Pdf::loadView('penilaianruangans.hisniru-peminjam', compact('penilaianruangan'))
        ->setPaper('A4', 'landscape'); // Set paper size to A4 landscape

        // Stream PDF ke browser dengan nama file yang sesuai
        return $pdf->stream($fileName);
    }

    public function penilaianpetugas()
    {
        $penilaianpetugas = PenilaianPetugas::with(['petugas'])->get();
        $data = [
            'penilaianpetugas' => $penilaianpetugas,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Riwayat Penilaian Petugas'
        ];

        $report = PDF::loadView('penilaianpetugas.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Riwayat Penilaian Petugas ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function penilaianpetugasbyid($id)
    {
        $penilaianpetugas = PenilaianPetugas::with(['petugas'])->where('id', $id)->first();
        $penilaianpetugasdata = PenilaianPetugas::with(['petugas'])->where('id', $id)->get();
        $data = [
            'penilaianpetugas' => $penilaianpetugas,
            'penilaianpetugasdata' => $penilaianpetugasdata,
            'tanggal' => date('d F Y'),
        ];
        return view('penilaianpetugas.printbyid', $data);
    }

    public function maintenance()
    {
        $maintenance = Maintenance::with(['ruangan'])->get();
        $data = [
            'maintenance' => $maintenance,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Maintenance'
        ];

        $report = PDF::loadView('maintenances.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Data Maintenance ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function barangrusak()
    {
        $barangrusak = BarangRusak::with(['ruangan'])->get();
        $data = [
            'barangrusak' => $barangrusak,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Riwayat Barang Rusak'
        ];

        $report = PDF::loadView('barangrusak.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Data Barang Rusak ' . $nama_tgl . '_' . $nama_jam . '.pdf');
    }

    public function barangrusakbyid($id)
    {
        $barangrusak = BarangRusak::with(['ruangan'])->where('id', $id)->first();
        $barangrusakdata = BarangRusak::with(['ruangan'])->where('id', $id)->get();
        $data = [
            'barangrusak' => $barangrusak,
            'barangrusakdata' => $barangrusakdata,
            'tanggal' => date('d F Y'),
        ];
        return view('barangrusak.printbyid', $data);
    }

    public function cetakBarangRusak(Request $request)
    {
        $barangrusak = BarangRusak::orderBy('id', 'desc')->get();
        $ruangan = Ruangan::all();
        $selected_ruangan = $request->input('selected_ruangan');
        $ruanganId = $request->input('ruangan');

        // Filter pengajuan berdasarkan divisi yang dipilih
        $barangrusak = BarangRusak::when($ruanganId, function ($query, $ruanganId) {
            $query->whereHas('ruangan', function ($query) use ($ruanganId) {
                $query->where('id', $ruanganId);
            });
        })->orderBy('id', 'desc')->get();

        // Tentukan nama divisi yang dipilih atau default ke 'semua divisi'
        $ruanganName = $ruanganId ? Ruangan::find($ruanganId)->nama_ruangan : 'semua_ruangan';

        // Generate PDF
        $pdf = Pdf::loadView('barangrusak.hisbar', compact('barangrusak', 'ruangan', 'selected_ruangan'))
        ->setPaper('A4', 'landscape'); // Set paper size to A4 landscape

        // Buat nama file dengan nama divisi yang dipilih
        $fileName = 'laporan_barangrusak_' . $ruanganName . '.pdf';

        return $pdf->stream($fileName);
    }
}
