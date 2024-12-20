@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profil</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil</label>
            <input type="file" class="form-control" id="foto_profil" name="foto_profil">
            @if (auth()->user()->foto_profil)
                <img src="{{ asset('uploads/foto_profil/' . auth()->user()->foto_profil) }}" alt="Foto Profil" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
