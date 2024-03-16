<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Anggota;
use App\Models\Periode;
use App\Models\Jadwal;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DateTimeZone, DateTime, DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_periode = Periode::orderByDesc('dari')->get();
        return view('jadwal_absensi.index', [
            'list_periode' => $list_periode,
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
        $validated = $request->validate([
            'bukti_kehadiran' => 'required|image|max:2048',
            'keterangan' => 'required|in:hadir,sakit,izin',
            'jadwal_id' => 'required|exists:'.Jadwal::class.',id',
        ]);

        $user = Auth::user();
        $anggota = Anggota::where('user_id', $user->id)->first();

        $filename = Cloudinary::upload($request->file('bukti_kehadiran')->getRealPath())->getSecurePath();

        $timezone = new DateTimeZone('Asia/Jakarta');
        $now = new DateTime('now', $timezone);
        $interval = DateInterval::createFromDateString('8 hours');

        $absensi  = new Absensi();
        $absensi->jadwal_id = $validated['jadwal_id'];
        $absensi->anggota_id = $anggota->id;
        $absensi->keterangan = $validated['keterangan'];
        $absensi->bukti_kehadiran = $filename;
        $absensi->jam_masuk = $now->format('Y-m-d H:i:s');
        $absensi->jam_keluar = $now->add($interval)->format('Y-m-d H:i:s');
        $absensi->save();

        $jadwal = Jadwal::find($validated['jadwal_id']);

        return redirect(route('jadwal-absensi.show', ['jadwal_absensi' => $jadwal->periode]))
            ->with('success', 'berhasil absen');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $jadwal_absensi)
    {
        $anggota = Anggota::with('user')->where('user_id', Auth::user()->id)->first();

        $list_jadwal = Jadwal::with('absensi')->where([
            ['periode_id', $jadwal_absensi->id],
            ['anggota_id', $anggota->id],
        ])->get();

        return view('jadwal_absensi.show', [
            "periode" => $jadwal_absensi,
            "anggota" => $anggota,
            "list_jadwal" => $list_jadwal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        
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
