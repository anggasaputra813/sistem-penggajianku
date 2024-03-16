<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PotonganGaji;
use Illuminate\Http\Request;

class PotonganGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $list_potongan_gaji = PotonganGaji::all();
        return view('potongan_gaji.index', [
            'list_potongan_gaji' => $list_potongan_gaji,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('potongan_gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|unique:'.PotonganGaji::class,
            'nilai_potongan' => 'required|numeric|gte:0'
        ]);

        $pg = new PotonganGaji();
        $pg->keterangan = $validated['keterangan'];
        $pg->nilai_potongan = $validated['nilai_potongan'];
        $pg->save();

        return redirect(route('potongan-gaji.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PotonganGaji $potonganGaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PotonganGaji $potonganGaji)
    {
        return view('potongan_gaji.edit', ['potongan_gaji' => $potonganGaji]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PotonganGaji $potonganGaji)
    {
        $validated = [];

        if(trim($request->input("keterangan")) != $potonganGaji->keterangan) {
            $validated = $request->validate([
                'keterangan' => 'required|string|unique:'.PotonganGaji::class,
                'nilai_potongan' => 'required|numeric|gte:0'
            ]);
        } else {
            $validated = $request->validate([
                'keterangan' => 'required|string',
                'nilai_potongan' => 'required|numeric|gte:0'
            ]);
        }
        
        if($potonganGaji->keterangan != 'potongan tidak hadir') {
            $potonganGaji->keterangan = $validated['keterangan'];
        }

        $potonganGaji->nilai_potongan = $validated['nilai_potongan'];
        $potonganGaji->save();

        return redirect(route('potongan-gaji.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PotonganGaji $potonganGaji)
    {
        
        if($potonganGaji->keterangan != 'potongan tidak hadir') {
            $potonganGaji->delete();
        }

        return redirect(route('potongan-gaji.index'));
    }
}
