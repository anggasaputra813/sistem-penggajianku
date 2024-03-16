<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id');
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class, 'jadwal_id', 'id');
    }

    public function jadwal_pengganti()
    {
        return $this->hasOne(JadwalPengganti::class, 'jadwal_id', 'id');
    }
}
