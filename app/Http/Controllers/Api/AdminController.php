<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(Booking::latest()->get());
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);
        return response()->json($booking);
    }

    public function login(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;

        // Cek credentials dari .env supaya aman
        if ($email === config('app.admin_email') && $password === config('app.admin_password')) {
            return response()->json(['message' => 'Login berhasil', 'user' => ['name' => 'Admin']]);
        }

        return response()->json(['message' => 'Email atau password salah'], 401);
    }
}