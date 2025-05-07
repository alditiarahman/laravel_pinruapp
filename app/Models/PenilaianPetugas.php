<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPetugas extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_surat', 'pelayanan', 'saran', 'id_petugas', 'id_peminjamen'];

    public function peminjamen()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjamen');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
}
