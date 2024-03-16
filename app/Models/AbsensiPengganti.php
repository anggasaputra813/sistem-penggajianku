<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPengganti extends Model
{
    use HasFactory;
    protected $table = 'absensi_pengganti';

    public function jadwal_pengganti() {
        return $this->belongsTo(JadwalPengganti::class, 'jadwal_pengganti_id', 'id');
    }
}
