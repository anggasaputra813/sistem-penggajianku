<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jadwal;
use App\Models\Periode;
use App\Models\PotonganGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \PDF;
use DateTime, DateInterval, DatePeriod, DateTimeZone;
use Illuminate\Support\Facades\Auth;

class LaporanGajiController extends Controller
{
    public function index()
    {

        $list_periode = Periode::all();
        return view('laporan_gaji.index', [
            'list_periode' => $list_periode,
        ]);
    } 

    public function generate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'periode_id' => 'required',
        ]);

        $periode = Periode::find($req->input('periode_id'));
        
        $timezone = new DateTimeZone("Asia/Jakarta");
        $interval = DateInterval::createFromDateString('1 day');

        $start = new DateTime($periode->dari, $timezone);
        $end = new DateTime($periode->hingga, $timezone);
        $end->add($interval);

        $validator->after(function($validator) use ($end) {
            if(/*time() <= $end->getTimestamp()*/false) {
                $validator->errors()->add('periode_id', 'periode ini belum selesai');
            }
        });

        $validated = $validator->validate();

        $range = new DatePeriod($start, $interval, $end);

        $total_periode_day = 0;
        foreach($range as $r) {
            $total_periode_day += 1;
        }

        $list_jadwal = Jadwal::with('absensi', 'jadwal_pengganti', 'jadwal_pengganti.absensi_pengganti', 'periode')->where("periode_id", $validated["periode_id"])->get();


        $list_anggota = Anggota::with(['user', 'jabatan', 'lokasi'])->get();
        $list_potongan = PotonganGaji::all();

        /*
        nama, jabatan, lokasi, gaji, hadir, sakit, izin, alpha, off
        */

        $list_potongan->find(1);
        $data = [];
        foreach($list_anggota as $anggota) {
            $datom = [
                "nama" => $anggota->user->nama,
                "nik" => $anggota->nik,
                "jabatan" => $anggota->jabatan->nama_jabatan,
                "lokasi" => $anggota->lokasi->nama_lokasi,
                "gaji" => $anggota->jabatan->gaji
            ];

            $jadwal_anggota = $list_jadwal->where("anggota_id", $anggota->id);
            $datom["alpha"] = $jadwal_anggota
                ->whereNull("absensi")
                ->count();
            $datom["off"] = $total_periode_day - $jadwal_anggota->count();
            $datom["hadir"] = 0;
            $datom["sakit"] = 0;
            $datom["izin"] = 0;
            $datom["lembur"] = 0;

            $list_jadwal_with_pengganti = $list_jadwal->whereNotNull("jadwal_pengganti");
            foreach($list_jadwal_with_pengganti as $j) {
                if($j->jadwal_pengganti->anggota_id == $anggota->id) {
                    $datom["lembur"] += 1;
                }
            }

            $dg_keterangan = $jadwal_anggota->whereNotNull("absensi");
            foreach($dg_keterangan as $dgk) {
                if($dgk->absensi->keterangan == "hadir") {
                    $datom["hadir"] = $datom["hadir"] + 1;
                }

                if($dgk->absensi->keterangan == "izin") {
                    $datom["izin"] = $datom["izin"] + 1;
                }

                if($dgk->absensi->keterangan == "sakit") {
                    $datom["sakit"] = $datom["sakit"] + 1;
                }
            }


            $total_potongan = 0;
            foreach($list_potongan as $potongan) {
                if($potongan->id == 1) {
                    $total_tidak_hadir = $datom['izin'] + $datom['sakit'] + $datom['alpha'];
                    $datom["upah_lembur"] = $potongan->nilai_potongan * $datom["lembur"];
                    $datom[$potongan->keterangan] = $potongan->nilai_potongan * $total_tidak_hadir;
                } else {
                    $datom[$potongan->keterangan] = $potongan->nilai_potongan;
                }

                $total_potongan += $datom[$potongan->keterangan];
            }

            $total_pendapatan = ($datom["upah_lembur"] + $datom["gaji"]);
            $datom["total_gaji"] = $total_pendapatan - $total_potongan;

            array_push($data, $datom);
        }

        $pdf = \PDF::loadView('laporan_gaji.report', [
            "data" => $data,
            "periode" => $periode,
            "list_potongan" => $list_potongan,
        ])->setPaper("a4", "landscape");
        return $pdf->download('laporan_gaji.pdf');
    }


    public function slip(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'periode_id' => 'required',
        ]);

        $periode = Periode::find($req->input('periode_id'));
        
        $timezone = new DateTimeZone("Asia/Jakarta");
        $interval = DateInterval::createFromDateString('1 day');

        $start = new DateTime($periode->dari, $timezone);
        $end = new DateTime($periode->hingga, $timezone);
        $end->add($interval);

        $validator->after(function($validator) use ($end) {
            if(/*time() <= $end->getTimestamp()*/false) {
                $validator->errors()->add('periode_id', 'periode ini belum selesai');
            }
        });

        $validated = $validator->validate();

        $range = new DatePeriod($start, $interval, $end);

        $total_periode_day = 0;
        foreach($range as $r) {
            $total_periode_day += 1;
        }

        $list_jadwal = Jadwal::with('absensi', 'jadwal_pengganti', 'jadwal_pengganti.absensi_pengganti', 'periode')->where("periode_id", $validated["periode_id"])->get();


        $anggota = Anggota::with(['user', 'jabatan', 'lokasi'])->where('user_id', Auth::user()->id)->first();
        $list_potongan = PotonganGaji::all();

        /*
        nama, jabatan, lokasi, gaji, hadir, sakit, izin, alpha, off
        */
        
        $data = [
            "nama" => $anggota->user->nama,
            "nik" => $anggota->nik,
            "jabatan" => $anggota->jabatan->nama_jabatan,
            "lokasi" => $anggota->lokasi->nama_lokasi,
            "gaji" => $anggota->jabatan->gaji
        ];

        $jadwal_anggota = $list_jadwal->where("anggota_id", $anggota->id);
        $data["alpha"] = $jadwal_anggota
            ->whereNull("absensi")
            ->count();
        $data["off"] = $total_periode_day - $jadwal_anggota->count();
        $data["hadir"] = 0;
        $data["sakit"] = 0;
        $data["izin"] = 0;
        $data["lembur"] = 0;

        $list_jadwal_with_pengganti = $list_jadwal->whereNotNull("jadwal_pengganti");
        foreach($list_jadwal_with_pengganti as $j) {
            if($j->jadwal_pengganti->anggota_id == $anggota->id) {
                $data["lembur"] += 1;
            }
        }

        $dg_keterangan = $jadwal_anggota->whereNotNull("absensi");
        foreach($dg_keterangan as $dgk) {
            if($dgk->absensi->keterangan == "hadir") {
                $data["hadir"] = $data["hadir"] + 1;
            }

            if($dgk->absensi->keterangan == "izin") {
                $data["izin"] = $data["izin"] + 1;
            }

            if($dgk->absensi->keterangan == "sakit") {
                $data["sakit"] = $data["sakit"] + 1;
            }
        }


        $total_potongan = 0;
        foreach($list_potongan as $potongan) {
            if($potongan->id == 1) {
                $total_tidak_hadir = $data['izin'] + $data['sakit'] + $data['alpha'];
                $data["upah_lembur"] = $potongan->nilai_potongan * $data["lembur"];
                $data[$potongan->keterangan] = $potongan->nilai_potongan * $total_tidak_hadir;
            } else {
                $data[$potongan->keterangan] = $potongan->nilai_potongan;
            }

            $total_potongan += $data[$potongan->keterangan];
        }

        $total_pendapatan = ($data["upah_lembur"] + $data["gaji"]);
        $data["total_gaji"] = $total_pendapatan - $total_potongan;

        $pdf = \PDF::loadView('laporan_gaji.slip', [
            "data" => $data,
            "periode" => $periode,
            "list_potongan" => $list_potongan,
        ]);
        return $pdf->download('slip_gaji.pdf');
    }
}
