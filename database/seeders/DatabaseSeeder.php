<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Lokasi;
use App\Models\Anggota;
use App\Models\Periode;
use App\Models\Jadwal;
use App\Models\PotonganGaji;
use DateInterval;
use DatePeriod;
use DateTimeZone;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $init_potongan = new PotonganGaji();
        $init_potongan->keterangan = "potongan tidak hadir";
        $init_potongan->nilai_potongan = 150000;
        $init_potongan->save();

        $init = new User();
        $init->nama = 'test admin';
        $init->email = 'test@email.com';
        $init->password = Hash::make('password');
        $init->role = 'admin';
        $init->save();

        $initLokasi = new Lokasi();
        $initLokasi->nama_lokasi = 'smb';
        $initLokasi->alamat = 'summarecon mall bekasi';
        $initLokasi->save();

        $initJabatan = new Jabatan();
        $initJabatan->nama_jabatan = 'anggota';
        $initJabatan->gaji = 8000000;
        $initJabatan->save();

        $initUserAnggota = new User();
        $initUserAnggota->nama = 'jaka';
        $initUserAnggota->email = 'jaka@email.com';
        $initUserAnggota->password = Hash::make('password');
        $initUserAnggota->role = 'anggota';
        $initUserAnggota->save();

        $initAnggota = new Anggota();
        $initAnggota->nik = '202308080001';
        $initAnggota->user_id = $initUserAnggota->id;
        $initAnggota->jabatan_id = $initJabatan->id;
        $initAnggota->lokasi_id = $initLokasi->id;
        $initAnggota->save();



        $initUser2 = new User();
        $initUser2->nama = 'joko';
        $initUser2->email = 'joko@email.com';
        $initUser2->password = Hash::make('password');
        $initUser2->role = 'anggota';
        $initUser2->save();

        $initAnggota2 = new Anggota();
        $initAnggota2->nik = '202308080002';
        $initAnggota2->user_id = $initUser2->id;
        $initAnggota2->jabatan_id = $initJabatan->id;
        $initAnggota2->lokasi_id = $initLokasi->id;
        $initAnggota2->save();



        $initUser3 = new User();
        $initUser3->nama = 'juki';
        $initUser3->email = 'juki@email.com';
        $initUser3->password = Hash::make('password');
        $initUser3->role = 'anggota';
        $initUser3->save();

        $initAnggota3 = new Anggota();
        $initAnggota3->nik = '202308080003';
        $initAnggota3->user_id = $initUser3->id;
        $initAnggota3->jabatan_id = $initJabatan->id;
        $initAnggota3->lokasi_id = $initLokasi->id;
        $initAnggota3->save();



        $timezone = new DateTimeZone('Asia/Jakarta');
        
        $first = new DateTime('now', $timezone);
        $first->modify('first day of this month');

        $last = new DateTime('now', $timezone);
        $last->modify('last day of this month');

        $initPeriode = new Periode();
        $initPeriode->dari = $first->format('Y-m-d');
        $initPeriode->hingga = $last->format('Y-m-d');
        $initPeriode->save();

        $interval = DateInterval::createFromDateString('1 day');
        $daterange = new DatePeriod($first, $interval, $last->add($interval));

        $jadwal_anggota = [];

        foreach($daterange as $curr) {
            $ja1 = [
                'anggota_id' => $initAnggota->id,
                'periode_id' => $initPeriode->id,
                'shift' => 'pagi',
                'tanggal' => $curr->format('Y-m-d'),
            ];
            array_push($jadwal_anggota, $ja1);

            $ja2 = [
                'anggota_id' => $initAnggota2->id,
                'periode_id' => $initPeriode->id,
                'shift' => 'siang',
                'tanggal' => $curr->format('Y-m-d'),
            ];
            array_push($jadwal_anggota, $ja2);

            $ja3 = [
                'anggota_id' => $initAnggota3->id,
                'periode_id' => $initPeriode->id,
                'shift' => 'malam',
                'tanggal' => $curr->format('Y-m-d'),
            ];
            array_push($jadwal_anggota, $ja3);
        }

        Jadwal::insert($jadwal_anggota);
    }
}
