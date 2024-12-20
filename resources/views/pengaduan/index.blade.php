@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pengaduan</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Isi Pengaduan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $item->masyarakat->nama }}
                    @if($item->masyarakat->foto_profil)
                        <img src="{{ asset('uploads/foto_profil/' . $item->masyarakat->foto_profil) }}" 
                             alt="Foto Profil" 
                             width="30" 
                             class="rounded-circle ms-2">
                    @endif
                </td>
                <td>{{ $item->isi_pengaduan }}</td>
                <td>
                    <span class="badge {{ $item->status === 'pending' ? 'bg-warning' : 'bg-success' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    @if(auth()->guard('petugas')->check() && $item->status === 'pending')
                        <a href="{{ route('pengaduan.tanggapi', $item->id) }}" 
                           class="btn btn-sm btn-success">
                            Tanggapi
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
