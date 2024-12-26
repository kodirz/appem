@extends('layouts.app')

@section('title', 'Update Data Petugas')

@section('container')
    <div class="container my-4">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="h3 mb-0">
                    <i class="fa-sharp fa-solid fa-users"></i> Update Data Petugas
                </h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-dark">
                            <div class="card-body">
                                <form action="{{ route('datapetugas.update', $datapetugas->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <!-- Input No Telepon -->
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No Telepon</label>
                                        <input type="text" id="no_telepon" name="no_telepon" class="form-control" 
                                            value="{{ old('no_telepon', $datapetugas->no_telepon) }}" required>
                                    </div>

                                    <!-- Input Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" 
                                            placeholder="Password">
                                    </div>

                                    <!-- Input Konfirmasi Password -->
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" 
                                            class="form-control" placeholder="Konfirmasi Password">
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Simpan
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
