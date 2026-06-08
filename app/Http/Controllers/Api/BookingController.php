<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string',
            'nim'         => 'required|string',
            'email'       => 'required|email',
            'telepon'     => 'required|string',
            'fasilitas_id'=> 'required|string',
            'tanggal'     => 'required|date',
            'waktu_mulai' => 'required',
            'durasi'      => 'required|integer',
            'tujuan'      => 'required|string',
        ]);

        // --- CEK BENTROK JADWAL ---
        // Hitung rentang waktu booking yang baru diajukan (dalam menit dari 00:00)
        $mulaiBaru   = $this->keMenit($request->waktu_mulai);
        $selesaiBaru = $mulaiBaru + ($request->durasi * 60);

        // Ambil semua booking APPROVED di ruangan & tanggal yang sama
        $approved = Booking::where('fasilitas_id', $request->fasilitas_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'approved')
            ->get();

        foreach ($approved as $b) {
            $mulaiAda   = $this->keMenit($b->waktu_mulai);
            $selesaiAda = $mulaiAda + ($b->durasi * 60);

            // Dua rentang bentrok jika: mulaiBaru < selesaiAda DAN mulaiAda < selesaiBaru
            if ($mulaiBaru < $selesaiAda && $mulaiAda < $selesaiBaru) {
                return response()->json([
                    'message' => "Jadwal bentrok! Ruangan {$request->fasilitas_id} pada tanggal {$request->tanggal} sudah dipesan jam {$b->waktu_mulai} ({$b->durasi} jam). Silakan pilih waktu lain."
                ], 409); // 409 = Conflict
            }
        }

        // Kalau aman, simpan booking
        $booking = Booking::create($request->all());
        return response()->json($booking, 201);
    }

    // Helper: ubah "09:00" jadi total menit (540)
    private function keMenit($waktu)
    {
        [$jam, $menit] = explode(':', $waktu);
        return ((int) $jam * 60) + (int) $menit;
    }
}