<?php

namespace App\Http\Controllers;

use App\Models\JadwalHarian;
use Illuminate\Http\Request;

class JadwalHarianController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalHarian $jadwal_harian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalHarian $jadwalHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalHarian $jadwal_harian)
    {
        $shift = $request->input('shift');

        $jadwal_harian->shift = $shift;
        $jadwal_harian->save();

        return redirect(route('jadwal.show', ['jadwal' => $jadwal_harian->jadwal_id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalHarian $jadwalHarian)
    {
        //
    }
}
