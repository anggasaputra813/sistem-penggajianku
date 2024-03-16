<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jabatan'];
    protected $table  = 'jabatan';

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'jabatan_id', 'id');
    }
}
