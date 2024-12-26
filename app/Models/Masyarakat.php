<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    protected $table = 'masyarakats';

    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'no_telepon',
        'foto_profil',
    ];
    protected $hidden = [
        'password',
    ];
}
