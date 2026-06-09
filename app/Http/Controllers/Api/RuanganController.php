<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\Booking;

class RuanganController extends Controller
{
    public function index()
    {
        return response()->json(Ruangan::all());
    }

    public function bookedSlots($nama)
    {
    $slots = Booking::where('fasilitas_id', $nama)
        ->where('status', 'approved')
        ->whereDate('tanggal', '>=', now()->toDateString()) // hanya tanggal hari ini & ke depan
        ->get(['tanggal', 'waktu_mulai', 'durasi']);
    return response()->json($slots);
    }
}