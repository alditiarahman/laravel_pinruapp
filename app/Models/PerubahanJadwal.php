<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerubahanJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_perubahan',
        'status',
        'alasan_perubahan',
        'id_peminjaman',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }
}
