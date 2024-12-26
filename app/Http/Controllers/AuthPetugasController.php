<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class AuthPetugasController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginpetugas');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Mencari petugas berdasarkan username
        $petugas = Petugas::where('username', $request->username)->first();

        if (!$petugas) {
            return back()->withErrors(['username' => 'Username yang Anda masukkan tidak terdaftar.'])->withInput();
        }

        // Verifikasi password
        if (Hash::check($request->password, $petugas->password)) {
            // Jika password valid, login menggunakan guard 'petugas' dan redirect ke dashboard
            Auth::guard('petugas')->login($petugas);
            return redirect()->intended('dashboardpetugas')->with('success', 'Login berhasil.');
        }

        return back()->withErrors(['password' => 'Password yang Anda masukkan salah.'])->withInput();
    }

    public function logout()
    {
        // Logout petugas
        Auth::guard('petugas')->logout();
        return redirect()->route('petugas.login')->with('success', 'Logout berhasil.');
    }
}
