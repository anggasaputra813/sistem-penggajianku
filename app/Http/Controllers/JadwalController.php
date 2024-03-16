<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalPengganti;
use App\Models\Absensi;
use App\Models\Anggota;
use App\Models\Periode;
use DateTime, DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_jadwal = Periode::orderByDesc('dari')->get();

        return view('jadwal.index', [
            'list_jadwal' => $list_jadwal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|string',
        ]);


        $timezone = new DateTimeZone('Asia/Jakarta');
        $strtime = strtotime($request->input('bulan'));
        $date = date("Y-m-d", $strtime);
        $dateTime = new DateTime($date, $timezone);

        $dateTime->modify("first day of this month");
        $dari = $dateTime->format("Y-m-d");

        $dateTime->modify("last day of this month");
        $hingga = $dateTime->format("Y-m-d");


        $exist = Periode::where('dari', $dari)->first();
        $validator->after(function($validator) use ($exist) {
            if($exist) {
                $validator->errors()->add('bulan', 'bulan tersebut sudah dibuat, pilih bulan lain');
            }
        });

        $validator->validate();        


        $periode = new Periode();
        $periode->dari = $dari;
        $periode->hingga = $hingga;
        $periode->save();

        return $this->index();
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $jadwal)
    {
        $periode = $jadwal;

        $list_anggota = Anggota::with([
            'jadwal' => function($query) use ($periode) {
                $query->where('periode_id', $periode->id);
            },
            'user' => function($query) {
                $query->orderBy('nama');
            },
        ])->get();


        return view('jadwal.show', [
            'list_anggota' => $list_anggota,
            'periode' => $periode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req,Periode $jadwal)
    {
        $ok = true;
        $childs = Jadwal::with('absensi', 'jadwal_pengganti')->where('periode_id', $jadwal->id)->get();
        foreach ($childs as $j) {
            if($j->absensi != null || $j->jadwal_pengganti != null) {
                $ok = false;
                $req->session()->flash('error_hapus_jadwal', 'sudah ada anggota yang absen di bulan tsb');
                return redirect()->back();
            }   
        }

        if($ok) {
            DB::table('jadwal')->where('periode_id', $jadwal->id)->delete();
            $jadwal->delete();
            return redirect(route('jadwal.index'));
        } else {
            $req->session()->flash('error_hapus_jadwal', 'sudah ada anggota yang absen di bulan tsb');
            return redirect()->back();
        }

    }
}
