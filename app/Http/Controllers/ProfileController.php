<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;
use App\Models\Petugas;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('profile.edit', compact('user'));
    }

    // Memproses pembaruan profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (Auth::guard('masyarakat')->check()) {
            $user = Masyarakat::find(Auth::guard('masyarakat')->id());
        } elseif (Auth::guard('petugas')->check()) {
            $user = Petugas::find(Auth::guard('petugas')->id());
        }

        // Update data dan simpan foto
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('foto_profil')) {
            // Simpan foto profil baru
            $fileName = time() . '.' . $request->foto_profil->extension();
            $request->foto_profil->move(public_path('uploads/foto_profil'), $fileName);

            // Hapus foto lama jika ada
            if ($user->foto_profil && file_exists(public_path('uploads/foto_profil/' . $user->foto_profil))) {
                unlink(public_path('uploads/foto_profil/' . $user->foto_profil));
            }

            $user->foto_profil = $fileName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
