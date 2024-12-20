<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;


Route::get('/', [PengaduanController::class, 'index'])->name('home');

// Routes untuk masyarakat
Route::middleware('auth:masyarakat')->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    
    // Rute edit profil untuk masyarakat
    Route::get('/profile/edit', [MasyarakatController::class, 'edit'])->name('masyarakat.profile.edit');
    Route::put('/profile/update', [MasyarakatController::class, 'update'])->name('masyarakat.profile.update');
});

// Routes untuk petugas  
Route::middleware('auth:petugas')->group(function () {
    Route::get('/pengaduan/{id}/tanggapi', [PengaduanController::class, 'tanggapi'])->name('pengaduan.tanggapi');
    Route::post('/pengaduan/{id}/tanggapi', [PengaduanController::class, 'storeTanggapan'])->name('pengaduan.storeTanggapan');
    
    // Rute edit profil untuk petugas
    Route::get('/profile/edit', [PetugasController::class, 'edit'])->name('petugas.profile.edit'); 
    Route::put('/profile/update', [PetugasController::class, 'update'])->name('petugas.profile.update');
});

// Routes untuk admin
Route::middleware('auth:admin')->group(function () {
    Route::resource('petugas', PetugasController::class);
});

// Tambahkan rute edit profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Menampilkan halaman edit profil
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // Memproses perubahan profil
});

// Rute autentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute pengaduan
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
});
