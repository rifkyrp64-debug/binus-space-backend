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
            'fasilitas_id'=> 'required|string',
            'tanggal'     => 'required',
            'waktu_mulai' => 'required',
            'durasi'      => 'required|integer',
            'tujuan'      => 'required|string',
        ]);

        $booking = Booking::create($request->all());
        return response()->json($booking, 201);
    }
}