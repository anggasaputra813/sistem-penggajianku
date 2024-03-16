<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_lokasi', 'alamat'];
    protected $table = 'lokasi';

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'lokasi_id', 'id');
    }
}
