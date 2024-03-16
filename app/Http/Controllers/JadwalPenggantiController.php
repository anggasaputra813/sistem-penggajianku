<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiPengganti;
use App\Models\Jadwal;
use App\Models\Anggota;
use App\Models\JadwalPengganti;
use Illuminate\Http\Request;

class JadwalPenggantiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Jadwal $jadwal)
    {
        $anggota = Anggota::with('user')->where('id', $jadwal->anggota_id)->first();
        $list_anggota = Anggota::with('user')->get();

        return view('jadwal_pengganti.create', [
            'jadwal' => $jadwal,
            'anggota' => $anggota,
            'list_anggota' => $list_anggota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:'.Jadwal::class.',id'
        ]);

        $jp = new JadwalPengganti();
        $jp->jadwal_id = $jadwal->id;
        $jp->anggota_id = $validated['anggota_id'];
        $jp->save();

        return redirect(route('list-absensi-anggota'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal, JadwalPengganti $jadwal_pengganti)
    {
        $pengganti = Anggota::with('user')->where('id', $jadwal_pengganti->anggota_id)->first();
        $anggota =  Anggota::with('user')->where('id', $jadwal->anggota_id)->first();
        $absensi = Absensi::where('jadwal_id', $jadwal->id)->first();
        $absensi_pengganti = AbsensiPengganti::where('jadwal_pengganti_id', $jadwal_pengganti->id)->first();

        return view('jadwal_pengganti.show', [
            'jadwal' => $jadwal,
            'jadwal_pengganti' => $jadwal_pengganti,
            'anggota' => $anggota,
            'pengganti' => $pengganti,
            'absensi' => $absensi,
            'absensi_pengganti' => $absensi_pengganti,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPengganti $jadwalPengganti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPengganti $jadwalPengganti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPengganti $jadwalPengganti)
    {
        //
    }
}
