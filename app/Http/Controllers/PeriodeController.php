<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Anggota;
use App\Models\JadwalHarian;
use App\Models\Periode;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PeriodeController extends Controller
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
        // TODO:
        //      - should be validated !!

        $validator = Validator::make($req->all(), [
            'bulan' => 'required',
        ]);

        $date = date("Y-m-d", strtotime($request->input('bulan')));
        $dateTime = new DateTime($date);

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
    public function show(Periode $periode)
    {
        $list_anggota = Anggota::with([
            ['jadwal' => function($query) use ($periode) {
                $query->where('periode_id', $periode->id);
            }],
            ['user' => function($query) {
                $query->orderBy('nama');
            }],
        ])->get();


        return view('jadwal.show', [
            'list_anggota' => $list_anggota,
            'periode' => $periode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        //
    }
}
