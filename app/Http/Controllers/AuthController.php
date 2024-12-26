<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Form login
    public function loginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('nama', 'password');

        // Mencari pengguna berdasarkan nama
        $user = Masyarakat::where('nama', $request->nama)->first(); // Sesuaikan dengan model dan kolom nama yang Anda gunakan
    
        if (!$user) {
            return back()->withErrors(['nama' => 'Nama yang Anda masukkan tidak terdaftar.']);
        }
    
        // Verifikasi password
        if (Hash::check($request->password, $user->password)) {
            // Jika password valid, login dan redirect ke dashboard
            Auth::login($user);
            return redirect()->intended('dashboardmasyarakat'); // Sesuaikan dengan halaman tujuan
        }
    
        return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    // Form register
    public function registerForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|unique:masyarakats,nik|digits:16',
            'nama' => 'required|string|max:255',
            // 'username' => 'required|unique:masyarakats,username|max:50',
            'password' => 'required|min:8|confirmed',
            'no_telepon' => 'required|digits_between:10,15',
        ]);

        try {
            // Buat user baru
            $masyarakat = Masyarakat::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                // 'username' => $request->username,
                'password' => Hash::make($request->password),
                'no_telepon' => $request->no_telepon,
                'foto_profil' => 'default.jpg', // Tambahkan nilai default jika diperlukan
            ]);

            // Login user setelah registrasi
            Auth::login($masyarakat);

            return redirect('/login')
                ->with('success', 'Akun berhasil dibuat dan Anda telah login.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage()]);
        }
    }
}
