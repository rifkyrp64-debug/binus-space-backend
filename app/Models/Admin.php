<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['nama', 'email', 'password'];

    // Sembunyikan password saat data dikirim sebagai JSON
    protected $hidden = ['password'];
}