<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $fillable = ['username', 'password', 'jabatan', 'foto_profile', 'no_telepon'];

    protected $hidden = ['password'];
}
