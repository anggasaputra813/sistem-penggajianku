<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_lokasi = Lokasi::all();
        return view('lokasi.index', ['list_lokasi' => $list_lokasi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'string|required|unique:'.Lokasi::class,
            'alamat' => 'string|required'
        ]);

        Lokasi::create($validated);

        return redirect(route('lokasi.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', ['lokasi' => $lokasi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'string|required',
            'alamat' => 'string|required'
        ]);

        $lokasi->nama_lokasi = $validated['nama_lokasi'];
        $lokasi->alamat = $validated['alamat'];
        $lokasi->save();

        return redirect(route('lokasi.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        return redirect(route('lokasi.index'));
    }
}
