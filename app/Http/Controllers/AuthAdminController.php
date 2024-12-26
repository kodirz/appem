<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginadmin'); // Menampilkan form login admin
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $role = Auth::user()->role;
            if($role == 'Admin')
            return redirect()->route('dashboard');
        } else {
            return back()->with('loginerror', 'Username atau Password salah!');
        }
    }

    // Proses logout admin
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login'); // Kembali ke halaman login setelah logout
    }
}
