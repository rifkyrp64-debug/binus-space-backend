<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'nama', 'nim', 'email', 'telepon',
        'fasilitas_id', 'tanggal', 'waktu_mulai',
        'durasi', 'tujuan', 'status', 'alasan_penolakan'
    ];
}