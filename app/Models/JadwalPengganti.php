<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPengganti extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pengganti';

    public function jadwal() 
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id');
    }

    public function absensi_pengganti()
    {
        return $this->hasOne(AbsensiPengganti::class, 'jadwal_pengganti_id', 'id');
    }
}
