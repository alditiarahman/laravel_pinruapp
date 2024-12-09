<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_ruangan', 'kapasitas', 'fasilitas', 'jumlah'];

    public function barangRusak()
    {
        return $this->hasMany(BarangRusak::class, 'id_ruangan');
    }
}
