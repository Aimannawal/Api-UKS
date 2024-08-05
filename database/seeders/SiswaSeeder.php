<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
            [
                'nama' => 'Ahmad',
                'foto' => 'ahmad.jpg',
                'kelas' => '10',
                'absen' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi',
                'foto' => 'budi.jpg',
                'kelas' => '11',
                'absen' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
