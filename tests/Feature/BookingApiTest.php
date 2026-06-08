<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ruangan;
use App\Models\Booking;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    /** Test: endpoint ruangan mengembalikan daftar ruangan */
    public function test_dapat_mengambil_daftar_ruangan(): void
    {
        Ruangan::create([
            'nama' => 'Ruang Kelas 301', 'kapasitas' => 40, 'gedung' => 'A', 'lantai' => 3
        ]);

        $response = $this->getJson('/api/ruangan');

        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonFragment(['nama' => 'Ruang Kelas 301']);
    }

    /** Test: pengguna dapat membuat booking baru */
    public function test_dapat_membuat_booking(): void
    {
        $data = [
            'nama' => 'Ahmad Fauzi',
            'nim' => '2301234567',
            'email' => 'ahmad@binus.ac.id',
            'telepon' => '0812345678',
            'fasilitas_id' => 'Ruang Kelas 301',
            'tanggal' => '2026-06-20',
            'waktu_mulai' => '09:00',
            'durasi' => 2,
            'tujuan' => 'Presentasi Proyek',
        ];

        $response = $this->postJson('/api/booking', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', ['nim' => '2301234567']);
    }

    /** Test: booking tanpa data wajib harus ditolak (validasi) */
    public function test_booking_tanpa_nama_ditolak(): void
    {
        $response = $this->postJson('/api/booking', [
            'nim' => '123', 'fasilitas_id' => 'Ruang Kelas 301',
        ]);

        $response->assertStatus(422); // 422 = Unprocessable (validasi gagal)
    }

    /** Test: admin dapat menyetujui booking */
    public function test_admin_dapat_menyetujui_booking(): void
    {
        $booking = Booking::create([
            'nama' => 'Siti', 'nim' => '2301234568',
            'email' => 'siti@binus.ac.id', 'telepon' => '0812345679',
            'fasilitas_id' => 'Lab Komputer A', 'tanggal' => '2026-06-21',
            'waktu_mulai' => '13:00', 'durasi' => 3,
            'tujuan' => 'Workshop', 'status' => 'pending',
        ]);

        $response = $this->putJson("/api/admin/bookings/{$booking->id}/status", [
            'status' => 'approved'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id, 'status' => 'approved'
        ]);
    }

    /** Test: login admin dengan kredensial benar */
    public function test_login_admin_berhasil(): void
    {
        config(['app.admin_email' => 'admin@binus.ac.id']);
        config(['app.admin_password' => 'admin123']);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@binus.ac.id',
            'password' => 'admin123',
        ]);

        $response->assertStatus(200);
    }

    /** Test: login admin dengan password salah ditolak */
    public function test_login_admin_gagal(): void
    {
        config(['app.admin_email' => 'admin@binus.ac.id']);
        config(['app.admin_password' => 'admin123']);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@binus.ac.id',
            'password' => 'salah',
        ]);

        $response->assertStatus(401);
    }
}