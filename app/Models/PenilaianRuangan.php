<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianRuangan extends Model
{
    use HasFactory;

    protected $fillable = ['id_ruangan', 'id_peminjam', 'kebersihan', 'kenyamanan', 'kelengkapan_fasilitas'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }
}
