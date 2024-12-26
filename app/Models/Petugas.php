<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'jabatan',
        'no_telepon',
    ];
    

    protected $hidden = ['password'];
}
