<?php

namespace App\Http\Controllers;

use App\Models\BarangRusak;
use App\Models\Maintenance;
use App\Models\Pembatalan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PenilaianPetugas;
use App\Models\PenilaianRuangan;
use App\Models\PerubahanJadwal;
use Carbon\Carbon;

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

        $report = PDF::loadView('peminjamans.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Riwayat Peminjaman ' . $nama_tgl . '_' . $nama_jam . '.pdf');
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
}
