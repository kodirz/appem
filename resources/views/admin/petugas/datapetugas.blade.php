@extends('layouts.app')
<title>Data Petugas</title>

@section('container')

<!-- Navbar -->

<!-- End of Navbar -->
<br>
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="h3 mb-0"><i class="fas fa-users"></i> Data Petugas</h3>
        </div>
        <div class="card-body">
            @if (session()->has('informasi'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('informasi') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="50px">No</th>
                            <th class="text-center">Nama Petugas</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">No Telp</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datapetugas as $petugas)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $petugas->nama_petugas }}</td>
                                <td>{{ $petugas->jabatan }}</td>
                                <td>{{ $petugas->no_telepon }}</td>
                                <td>{{ $petugas->username }}</td>
                                <td class="text-center">
                                    <!-- Link untuk edit, pastikan rutenya mengarah ke halaman edit petugas -->
                                    <a href="{{ route('datapetugas.edit', $petugas->id) }}" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <!-- Form untuk delete petugas -->
                                    <form action="{{ route('datapetugas.destroy', $petugas->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm mx-1" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
