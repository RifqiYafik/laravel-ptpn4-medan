<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'ptpn4@gmail.com',
        //     'password' => Hash::make('medan123'),
        // ]);

        // Seeder untuk tabel sekolahs
        $schools = [
            ['name' => 'SMK N 1 Medan'],
            ['name' => 'SMK N 12 Medan'],
            ['name' => 'SMK N 2 Medan'],
            ['name' => 'SMK N 3 Medan'],
            ['name' => 'SMK N 9 Medan'],
        ];

        foreach ($schools as $school) {
            DB::table('sekolahs')->insert(array_merge($school, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // Seeder untuk tabel penempatans
        $placements = [
            ['name' => 'Gedung Akuntansi'],
            ['name' => 'Kantor'],
            ['name' => 'Umum'],
            ['name' => 'Utama'],
        ];

        foreach ($placements as $placement) {
            DB::table('penempatans')->insert(array_merge($placement, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // Seeder untuk tabel siswas
        foreach ($schools as $school_id => $school) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('siswas')->insert([
                    'nama_siswa' => "Siswa $i {$school['name']}",
                    'id_siswa' => rand(1000, 9999),
                    'tmpt_lahir' => "Medan",
                    'tgl_lahir' => Carbon::parse('200' . rand(0, 9) . '-0' . rand(1, 9) . '-' . rand(10, 28)),
                    'jenis_kelamin' => (rand(0, 1) ? 'l' : 'p'),
                    'alamat' => "Alamat Siswa $i {$school['name']}",
                    'sekolah_id' => $school_id + 1,
                    'penempatan_id' => rand(1, count($placements)),
                    'tgl_masuk' => Carbon::now()->subYears(rand(1, 3)),
                    'tgl_keluar' => Carbon::now(),
                    'no_hp' => '08123456789' . rand(0, 9),
                    'image' => 'default.jpg',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
