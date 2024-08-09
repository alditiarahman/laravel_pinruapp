<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ['id_ruangan', 'id_peminjam', 'id_petugas', 'nomor_surat', 'tanggal_mulai', 'tanggal_selesai', 'nama_pj', 'jabatan', 'instansi', 'nomor_identitas', 'nomor_telepon', 'status', 'jumlah_hari', 'keperluan'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }

    public function calculateJumlahHari()
    {
        $startDate = \Carbon\Carbon::parse($this->tanggal_mulai);
        $endDate = \Carbon\Carbon::parse($this->tanggal_selesai);

        return $startDate->diffInDays($endDate) + 1; // Adding 1 to include both start and end dates
    }

}
