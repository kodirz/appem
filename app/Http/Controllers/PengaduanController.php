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
        // Mengambil semua pengaduan beserta relasi masyarakat dan petugas
        $pengaduan = Pengaduan::with(['masyarakat', 'petugas'])->get();
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
        // Validasi input
        $request->validate([
            'isi_pengaduan' => 'required|min:10|max:500',
        ], [
            'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
            'isi_pengaduan.min' => 'Isi pengaduan harus memiliki minimal 10 karakter.',
            'isi_pengaduan.max' => 'Isi pengaduan maksimal 500 karakter.',
        ]);

        // Simpan pengaduan ke database
        Pengaduan::create([
            'nik' => auth('masyarakat')->user()->nik, // Menggunakan guard masyarakat
            'isi_pengaduan' => $request->isi_pengaduan,
            // 'status' => '',
        ]);

        return redirect()->route('dashboardmasyarakat')->with('success', 'Pengaduan berhasil dikirim.');
    }

    // Halaman untuk petugas memberikan tanggapan
    public function tanggapi($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.tanggapi', compact('pengaduan'));
    }

    // Simpan tanggapan petugas
    public function storeTanggapan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggapan' => 'required|string|min:10|max:1000',
        ], [
            'tanggapan.required' => 'Tanggapan wajib diisi.',
            'tanggapan.min' => 'Tanggapan harus memiliki minimal 10 karakter.',
            'tanggapan.max' => 'Tanggapan maksimal 1000 karakter.',
        ]);

        // Temukan pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        // Update status dan tambahkan tanggapan
        $pengaduan->update([
            'id_petugas' => auth('petugas')->user()->id, // Menggunakan guard petugas
            'tanggapan' => $request->tanggapan,
            'status' => 'selesai',
        ]);

        return redirect()->route('dashboard')->with('success', 'Tanggapan berhasil disimpan.');
    }
}
