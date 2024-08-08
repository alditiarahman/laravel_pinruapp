<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ['id_ruangan', 'id_peminjam', 'id_petugas', 'tanggal_pinjam', 'nama_pj', 'jabatan', 'instansi', 'nomor_identitas', 'nomor_telepon', 'status', 'keperluan'];

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

}
