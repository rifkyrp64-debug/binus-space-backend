<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangan = [
            ['nama' => 'Ruang Kelas 301', 'kapasitas' => 40, 'gedung' => 'A', 'lantai' => 3],
            ['nama' => 'Lab Komputer A',  'kapasitas' => 30, 'gedung' => 'B', 'lantai' => 4],
        ];

        foreach ($ruangan as $r) {
            Ruangan::updateOrCreate(['nama' => $r['nama']], $r);
        }
    }
}