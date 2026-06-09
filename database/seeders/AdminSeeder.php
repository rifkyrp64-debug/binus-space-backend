<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['nama' => 'Admin Utama', 'email' => 'admin@binus.ac.id', 'password' => 'admin123'],
            ['nama' => 'Rifky',       'email' => 'muhamad.perkasa001@binus.ac.id', 'password' => 'rifky123'],
            ['nama' => 'Aria',       'email' => 'aria.putro@binus.ac.id', 'password' => 'aria123'],
            ['nama' => 'Malvin',       'email' => 'malvin.muliawan@binus.ac.id', 'password' => 'malvin123'],
            ['nama' => 'Charly',       'email' => 'charly.prayoga@binus.ac.id', 'password' => 'charly123'],

            // Tambah temen kamu di sini:
            // ['nama' => 'Budi', 'email' => 'budi@binus.ac.id', 'password' => 'budi123'],
        ];

        foreach ($admins as $a) {
            Admin::updateOrCreate(
                ['email' => $a['email']], // cek berdasarkan email biar gak dobel
                ['nama' => $a['nama'], 'password' => Hash::make($a['password'])]
            );
        }
    }
}