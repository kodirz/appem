<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;

class MasyarakatController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'foto_profil' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Masyarakat::find(Auth::guard('masyarakat')->id());

        if ($request->hasFile('foto_profil')) {
            // Buat folder jika belum ada
            $uploadPath = public_path('uploads/foto_profil');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Simpan file ke folder 'uploads/foto_profil'
            $fileName = time() . '.' . $request->foto_profil->extension();
            $request->foto_profil->move($uploadPath, $fileName);

            // Hapus foto lama jika ada
            if ($user->foto_profil && file_exists($uploadPath . '/' . $user->foto_profil)) {
                unlink($uploadPath . '/' . $user->foto_profil);
            }

            $user->foto_profil = $fileName;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
