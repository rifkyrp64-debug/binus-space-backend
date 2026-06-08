<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        Ruangan::insert([
            ['nama' => 'Ruang Kelas 301', 'kapasitas' => 40, 'gedung' => 'A', 'lantai' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Lab Komputer A',  'kapasitas' => 30, 'gedung' => 'B', 'lantai' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}