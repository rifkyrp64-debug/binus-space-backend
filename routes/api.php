<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RuanganController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AdminController;

Route::get('/ruangan', [RuanganController::class, 'index']);
Route::get('/ruangan/{nama}/booked', [RuanganController::class, 'bookedSlots']);
Route::post('/booking', [BookingController::class, 'store']);

Route::post('/login', [AdminController::class, 'login']);
Route::get('/admin/bookings', [AdminController::class, 'index']);
Route::put('/admin/bookings/{id}/status', [AdminController::class, 'updateStatus']);