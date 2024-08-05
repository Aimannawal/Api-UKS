<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;
use App\Models\Siswa;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswaIds = Siswa::pluck('id');

        Pasien::insert([
            [
                'keluhan' => 'Headache',
                'siswa_id' => $siswaIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keluhan' => 'Fever',
                'siswa_id' => $siswaIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
