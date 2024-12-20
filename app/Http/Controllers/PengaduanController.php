<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use App\Models\Petugas;

class PengaduanController extends Controller
{
    // Halaman utama pengaduan
    public function index()
    {
        $pengaduan = Pengaduan::with('masyarakat', 'petugas')->get();
        return view('pengaduan.index', compact('pengaduan'));
    }

    // Form untuk masyarakat membuat pengaduan 
    public function create()
    {
        return view('pengaduan.create');
    }

    // Simpan pengaduan
    public function store(Request $request)
{
    $request->validate([
        'isi_pengaduan' => 'required|min:10|max:500',
    ], [
        'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
        'isi_pengaduan.min' => 'Isi pengaduan harus memiliki minimal 10 karakter.',
        'isi_pengaduan.max' => 'Isi pengaduan maksimal 500 karakter.',
    ]);

        Pengaduan::create([
            'nik' => auth('masyarakat')->user()->nik, // Menggunakan guard masyarakat
            'isi_pengaduan' => $request->isi_pengaduan,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Pengaduan berhasil dikirim.');
    }

    // Tanggapan petugas
    public function tanggapi($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.tanggapi', compact('pengaduan'));
    }

    public function storeTanggapan(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'id_petugas' => auth('petugas')->user()->id_petugas, // Menggunakan guard petugas
            'status' => 'selesai',
        ]);

        return redirect()->route('home')->with('success', 'Tanggapan berhasil disimpan.');
    }
}
