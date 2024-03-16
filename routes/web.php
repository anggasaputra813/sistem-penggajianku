<?php

use App\Http\Controllers\AbsensiAnggota;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AnggotaJadwalController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JadwalAbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalAnggotaController;
use App\Http\Controllers\JadwalHarianController;
use App\Http\Controllers\JadwalLemburController;
use App\Http\Controllers\JadwalPenggantiController;
use App\Http\Controllers\LaporanGajiController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PotonganGajiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();

    if($user == null) {
        return redirect('/login');
    }

    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin_only')->group(function() {
        Route::resource('lokasi', LokasiController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('anggota', AnggotaController::class);
        Route::resource('jadwal', JadwalController::class);
        Route::resource('jadwal-anggota', JadwalAnggotaController::class)->only('update', 'store');
        Route::resource('potongan-gaji', PotonganGajiController::class);
        Route::get('/absensi-anggota', [AbsensiAnggota::class, 'index'])->name('list-absensi-anggota');
        Route::get('/absensi-anggota/{jadwal}/pengganti/create', [JadwalPenggantiController::class, 'create'])->name("create-jadwal-pengganti");
        Route::post('/absensi-anggota/{jadwal}/pengganti/create', [JadwalPenggantiController::class, 'store'])->name("store-jadwal-pengganti");
        Route::get('/absensi-anggota/{jadwal}/pengganti/{jadwal_pengganti}', [JadwalPenggantiController::class, 'show'])->name("detail-jadwal-pengganti");
        Route::get('/laporan-gaji', [LaporanGajiController::class, 'index'])->name('laporan-gaji');
        Route::post('/laporan-gaji', [LaporanGajiController::class, 'generate'])->name('generate-laporan-gaji');
    });

    Route::middleware('anggota_only')->group(function() {

        Route::resource('jadwal-absensi', JadwalAbsensiController::class);
        Route::get('/jadwal-lembur', [JadwalLemburController::class, 'index'])->name('list-jadwal-lembur');
        Route::get('/jadwal-lembur/{jadwal_pengganti}/create', [JadwalLemburController::class, 'create'])->name('create-jadwal-lembur');
        Route::post('/jadwal-lembur/{jadwal_pengganti}', [JadwalLemburController::class, 'store'])->name('store-jadwal-lembur');

        Route::get('/slip-gaji', [LaporanGajiController::class, 'index'])->name('index-slip');
        Route::post('/slip-gaji', [LaporanGajiController::class, 'slip'])->name('generate-slip-gaji');


    });

});

require __DIR__.'/auth.php';
