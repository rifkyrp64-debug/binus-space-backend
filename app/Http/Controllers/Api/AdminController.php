<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(Booking::latest()->get());
    }

    public function updateStatus(Request $request, $id)
    {
    $booking = Booking::findOrFail($id);

    $booking->status = $request->status;
    $booking->diproses_oleh = $request->diproses_oleh; // nama admin yang memproses

    // Kalau ditolak, simpan alasannya juga
    if ($request->status === 'rejected') {
        $booking->alasan_penolakan = $request->alasan_penolakan;
    }

    $booking->save();

    return response()->json($booking);
    }
    public function login(Request $request)
    {
    $admin = Admin::where('email', $request->email)->first();

    // Cek admin ada & password cocok (bandingkan dengan hash)
    if ($admin && Hash::check($request->password, $admin->password)) {
        return response()->json([
            'message' => 'Login berhasil',
            'user' => ['nama' => $admin->nama, 'email' => $admin->email]
        ]);
    }

    return response()->json(['message' => 'Email atau password salah'], 401);
    }
}