<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jadwal;
use App\Models\Periode;
use Illuminate\Http\Request;

class JadwalAnggotaController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "anggota_id" => "required|exists:".Anggota::class.",id",
            "periode_id" => "required|exists:".Periode::class.",id",
            "tanggal" => "required|date",
            "shift" => "required|in:pagi,siang,malam",
        ]);

        $jadwal = new Jadwal();
        $jadwal->anggota_id = $validated['anggota_id'];
        $jadwal->periode_id = $validated['periode_id'];
        $jadwal->tanggal = $validated['tanggal'];
        $jadwal->shift = $validated['shift'];
        $jadwal->save();

        $periode = Periode::find($jadwal->periode->id);

        return redirect(route("jadwal.show", ["jadwal" => $periode]));
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
    public function update(Request $request, Jadwal $jadwal_anggotum)
    {
        
        $validated = $request->validate([
            "shift" => "required|in:pagi,siang,malam,off",
        ]);

        $periode = Periode::find($jadwal_anggotum->periode_id);

        if($validated['shift'] == 'off') {
            $jadwal_anggotum->delete();

            return redirect(route("jadwal.show", ["jadwal" => $periode]));
        }

        $jadwal_anggotum->shift = $validated['shift'];
        $jadwal_anggotum->save();

        return redirect(route("jadwal.show", ["jadwal" => $periode]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
