@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Pengaduan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="isi_pengaduan" class="form-label">Isi Pengaduan</label>
            <textarea 
                class="form-control @error('isi_pengaduan') is-invalid @enderror"
                id="isi_pengaduan" 
                name="isi_pengaduan"
                rows="5"
                required
            >{{ old('isi_pengaduan') }}</textarea>
            @error('isi_pengaduan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
    </form>
</div>
@endsection
