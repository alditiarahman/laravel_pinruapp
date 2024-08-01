<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPetugas extends Model
{
    use HasFactory;

    protected $fillable = ['pelayanan', 'saran', 'id_petugas'];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
}
