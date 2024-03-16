<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_jabatan = Jabatan::all();
        return view('jabatan.index', ['list_jabatan' => $list_jabatan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'string|required|unique:'.Jabatan::class,
            'gaji' => 'required|numeric|gte:0',
        ]);

        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = $validated['nama_jabatan'];
        $jabatan->gaji = $validated['gaji'];
        $jabatan->save();

        return redirect(route('jabatan.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', ['jabatan' => $jabatan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = [];
        if($request->input('nama_jabatan') == $jabatan->nama_jabatan) {

            $validated = $request->validate([
                'nama_jabatan' => 'string|required',
                'gaji' => 'numeric|gte:0',
            ]);

        } else {

            $validated = $request->validate([
                'nama_jabatan' => 'string|required|unique:'.Jabatan::class,
                'gaji' => 'numeric|gte:0',
            ]);

        }

        $validated = $request->validate([
            'nama_jabatan' => 'string|required',
            'gaji' => 'numeric|gte:0',
        ]);

        $jabatan->nama_jabatan = $validated['nama_jabatan'];
        $jabatan->gaji = $validated['gaji'];
        $jabatan->save();

        return redirect(route('jabatan.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect(route('jabatan.index'));
    }
}
