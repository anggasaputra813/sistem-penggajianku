<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jadwal;
use App\Models\Periode;
use Illuminate\Http\Request;

class AbsensiAnggota extends Controller
{
    public function index(Request $req)
    {
        $anggota_id = $req->query('anggota_id');
        $periode_id = $req->query('periode_id');

        $anggota = Anggota::find($anggota_id);
        $periode = Periode::find($periode_id);

        if($anggota != null && $periode != null) {
            $list_jadwal = Jadwal::with('absensi', 'jadwal_pengganti')->where([
                    'anggota_id' => $anggota->id,
                    'periode_id' => $periode->id,
                ])
                ->get();
            $list_anggota = Anggota::with('user')->get();
            $list_periode = Periode::all();

            return view('absensi_anggota.index', [
                "list_periode" => $list_periode,
                "list_anggota" => $list_anggota,
                "list_jadwal" => $list_jadwal,
                "periode" => $periode,
                "anggota" => $anggota,
            ]);
        } else {
            $list_anggota = Anggota::with('user')->get();
            $list_periode = Periode::all();

            return view('absensi_anggota.form', [
                "list_periode" => $list_periode,
                "list_anggota" => $list_anggota,
            ]);
        }

    }
}
