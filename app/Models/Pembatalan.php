<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembatalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pembatalan',
        'alasan_pembatalan',
        'id_peminjaman',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }
}
