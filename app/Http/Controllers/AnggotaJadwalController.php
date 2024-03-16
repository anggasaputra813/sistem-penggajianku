<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jadwal;
use App\Models\JadwalHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $month = date('Y-m');

        $anggota = Anggota::where('user_id', $user->id)->first();
        $jadwal = Jadwal::where('bulan', $month)->first();
        $list_jadwal = Jadwal::all();

        $list_jadwal_harian = JadwalHarian::where([
            ['anggota_id', $anggota->id],
            ['jadwal_id', $jadwal->id],
        ])->get();

        return view('anggota_jadwal.index', [
            'anggota' => $anggota,
            'jadwal' => $jadwal,
            'list_jadwal' => $list_jadwal,
            'list_jadwal_harian' => $list_jadwal_harian,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
