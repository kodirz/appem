<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    protected $fillable = ['nik', 'nama', 'username', 'password', 'no_telepon', 'foto_profile'];

    protected $hidden = ['password'];
}
