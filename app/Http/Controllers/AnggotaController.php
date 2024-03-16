<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jabatan;
use App\Models\Jadwal;
use App\Models\JadwalHarian;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_anggota = Anggota::with('user', 'jabatan')->get();

        return view('anggota.index', [
            'list_anggota' => $list_anggota,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_jabatan = Jabatan::all();
        $list_lokasi = Lokasi::all();

        return view('anggota.create', [
            'list_jabatan' => $list_jabatan,
            'list_lokasi' => $list_lokasi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'string|required',
            'nik' => 'numeric|required|unique:'.Anggota::class,
            'email' => 'string|required|email|unique:'.User::class,
            'password' => 'string|required|confirmed',
            'jabatan_id' => 'numeric|required|exists:'.Jabatan::class.',id',
            'lokasi_id' => 'required|numeric|exists:'.Lokasi::class.',id',
        ]);



        $user = new User();
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role = 'anggota';
        $user->save();

        $anggota = new Anggota();
        $anggota->nik = $validated['nik'];
        $anggota->user_id = $user->id;
        $anggota->lokasi_id = $validated['lokasi_id'];
        $anggota->jabatan_id = $validated['jabatan_id'];
        $anggota->save();

        DB::transaction(function() use ($anggota, $user) {
            $user->save();
            $anggota->save();
        });

        return redirect(route('anggota.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggotum)
    {


        $list_jabatan = Jabatan::all();
        $list_lokasi = Lokasi::all();

        return view('anggota.edit', [
            'anggota' => $anggotum,
            'list_jabatan' => $list_jabatan,
            'list_lokasi' => $list_lokasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggotum)
    {
        $validated = $request->validate([
            'nama' => 'string|required',
            'jabatan_id' => 'numeric|required|exists:'.Jabatan::class.',id',
            'lokasi_id' => 'required|numeric|exists:'.Lokasi::class.',id',
            'gaji' => 'numeric|gte:0',
        ]);

        $anggotum->jabatan_id = $validated['jabatan_id'];
        $anggotum->lokasi_id = $validated['lokasi_id'];
        
        $user = $anggotum->user;
        $user->nama = $validated['nama'];
        
        if($request->input('nik') != $anggotum->nik) {
            $validated = $request->validate(['nik' => 'numeric|required|unique:'.Anggota::class]);

            $anggotum->nik = $validated['nik'];
        }

        $anggotum->save();
        $user->save();

        
        return redirect(route('anggota.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggotum)
    {   
       $user =  $anggotum->user();
       $user->delete();

        return redirect(route('anggota.index'));
    }
}
