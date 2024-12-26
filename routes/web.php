<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserMasController;
use App\Http\Controllers\AuthPetugasController;
use App\Http\Controllers\AuthAdminController;

// Rute autentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//petugas login
Route::get('/loginpetugas', [AuthPetugasController::class, 'showLoginForm'])->name('petugas.login');
Route::post('/loginpetugas', [AuthPetugasController::class, 'login']);
//logout petugas
Route::post('/logoutpetugas', [AuthPetugasController::class, 'logout'])->name('petugas.logout');

// Dashboard Petugas setelah login
Route::get('/dashboardpetugas', function () {
    return view('dashboardpetugas');
})->middleware('auth:petugas');


//login admin
Route::get('/loginadmin', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/loginadmin', [AuthAdminController::class, 'login'])->name('admin.login.submit');
Route::post('/logoutadmin', [AuthAdminController::class, 'logout'])->name('admin.logout');

// Dashboard admin
Route::get('/dashboardadmin', function () {
    return view('layouts.app'); // Ganti dengan controller jika diperlukan
})->middleware('auth:admin');

// Rute register
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rute untuk masyarakat
Route::middleware('auth:masyarakat')->group(function () {
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('masyarakat.pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('masyarakat.pengaduan.store');

    // Rute profil masyarakat
    // Route::get('/profile/edit', [MasyarakatController::class, 'edit'])->name('masyarakat.profile.edit');
    // Route::put('/profile/update', [MasyarakatController::class, 'update'])->name('masyarakat.profile.update');
});

// Rute untuk petugas
Route::middleware('auth:petugas')->group(function () {
    Route::get('/pengaduan/{id}/tanggapi', [PengaduanController::class, 'tanggapi'])->name('pengaduan.tanggapi');
    Route::post('/pengaduan/{id}/tanggapi', [PengaduanController::class, 'storeTanggapan'])->name('pengaduan.storeTanggapan');

    // Rute profil petugas
    Route::get('/profile/edit', [PetugasController::class, 'edit'])->name('petugas.profile.edit'); 
    Route::put('/profile/update', [PetugasController::class, 'update'])->name('petugas.profile.update');
});

// Rute untuk admin
Route::middleware('auth:admin')->group(function () {
    Route::resource('petugas', PetugasController::class);
});

// Rute dashboard umum
// Route::middleware('dashboard')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
// });

Route::resource('/datapetugas', AdminController::class,);

Route::get('/dashboardpetugas', [PetugasController::class, 'index'])->name('dashboard.petugas');

Route::get('/dashboardmasyarakat', [UserMasController::class, 'index'])->name('dashboard.masyarakat');

Route::get('/profil/profilemasyarakat', function(){
    return view('profil.profilemasyarakat');
});

Route::put('/datapetugas/{id}', [AdminController::class, 'update'])->name('datapetugas.update');
Route::get('/datapetugas/{id}/edit', [AdminController::class, 'edit'])->name('datapetugas.edit');
