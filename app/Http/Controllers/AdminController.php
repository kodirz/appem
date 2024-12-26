<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datapetugas = Petugas::all();
        return view('admin.petugas.datapetugas', compact('datapetugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.petugas.createpetugas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:petugas,username',
            // 'role' => 'required|string|in:petugas', // Pastikan hanya role yang valid diterima
            'password' => 'required|min:6|confirmed',
            'jabatan' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15',
        ]);
    
        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            // 'role'      => $request->role,
            'password' => bcrypt($request->password),
            'jabatan' => $request->jabatan,
            'no_telepon' => $request->no_telepon,
        ]);
        
        return redirect()->route('datapetugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $petugas = Petugas::find($id);
        if (!$petugas) {
            abort(404);
        }
        return view('admin.petugas.show', ['petugas' => $petugas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.petugas.updatepetugas',[
            'datapetugas' => Petugas::where('id',$id)->first() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $petugas = Petugas::find($id);
        if (!$petugas) {
            abort(404);  // Jika petugas tidak ditemukan
        }
    
        // Validasi input
        $request->validate([
            'no_telepon' => 'required|string|max:15',  // Validasi untuk no telepon
            'password' => 'sometimes|min:6|confirmed',  // Validasi password, jika ada perubahan
        ]);
    
        // Update no_telepon
        $petugas->no_telepon = $request->no_telepon;
    
        // Update password jika ada perubahan
        if ($request->has('password') && $request->password != '') {
            $petugas->password = bcrypt($request->password);
        }
    
        // Simpan perubahan
        $petugas->save();
    
        return redirect()->route('datapetugas.index')->with('success', 'Data petugas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petugas = Petugas::find($id);
        if (!$petugas) {
            abort(404);
        }
        $petugas->delete();
        return redirect()->route('datapetugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
