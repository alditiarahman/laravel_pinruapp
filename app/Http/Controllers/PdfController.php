<?php

namespace App\Http\Controllers;

use App\Models\Pembatalan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PerubahanJadwal;

class PdfController extends Controller
{
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['ruangan', 'peminjam', 'petugas'])->get();
        $data = [
            'peminjaman' => $peminjaman,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Peminjaman'
        ];

        $report = PDF::loadView('peminjamans.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('Laporan Data Peminjaman ' . $nama_tgl . '_' . $nama_jam . '.pdf');
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
        $perubahanjadwal = PerubahanJadwal::with(['peminjaman','petugas', 'peminjam'])->get();
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
}
