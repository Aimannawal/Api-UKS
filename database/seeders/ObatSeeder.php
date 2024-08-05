<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obat::insert([
            [
                'nama' => 'Paracetamol',
                'foto' => 'paracetamol.jpg',
                'deskripsi' => 'Pain reliever and fever reducer',
                'stok' => 100,
                'tanggal_kadaluarsa' => '2024-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Aspirin',
                'foto' => 'aspirin.jpg',
                'deskripsi' => 'Anti-inflammatory and blood thinner',
                'stok' => 50,
                'tanggal_kadaluarsa' => '2023-08-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
