<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'anggota_id', 'id');
    }

    public function jadwal_pengganti()
    {
        return $this->hasMany(JadwalPengganti::class, 'anggota_id', 'id');
    }
}
