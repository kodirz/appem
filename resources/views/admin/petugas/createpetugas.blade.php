@extends('layouts.app')

@section('title', 'Menambah Data Petugas')

@section('container')
    <div class="container my-4">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="h3 mb-0">
                    <i class="fa-sharp fa-solid fa-users"></i> Tambah Data Petugas
                </h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-dark">
                            <div class="card-body">
                                <form action="/datapetugas" method="POST">
                                    @csrf
                                    <!-- Input Nama Petugas -->
                                    <div class="mb-3">
                                        <label for="nama_petugas" class="form-label">Nama Petugas</label>
                                        <input type="text" id="nama_petugas" name="nama_petugas" class="form-control" 
                                            placeholder="Nama Petugas" autocomplete="off" required>
                                    </div>

                                    <!-- Input Jabatan -->
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <input type="text" id="jabatan" name="jabatan" class="form-control" 
                                            placeholder="Jabatan" autocomplete="off" required>
                                    </div>

                                    <!-- Input No Telepon -->
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No Telepon</label>
                                        <input type="text" id="no_telepon" name="no_telepon" class="form-control" 
                                            placeholder="No Telepon" autocomplete="off" required>
                                    </div>

                                    <!-- Input Username -->
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" 
                                            placeholder="Username" autocomplete="off" required>
                                    </div>

                                    <!-- Input Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" 
                                            placeholder="Password" autocomplete="off" required>
                                    </div>

                                    <!-- Input Konfirmasi Password -->
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                                            placeholder="Konfirmasi Password" autocomplete="off" required>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="/dashboard" class="btn btn-danger">
                                            <i class="bi bi-box-arrow-in-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-journal-check"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
