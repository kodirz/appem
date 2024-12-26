<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Register - Pengaduan Masyarakat</title>
</head>
<body>
<main>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" id="form1Example13" class="form-control form-control-lg" name="nik" required />
            <label class="form-label" for="form1Example13">NIK</label>
            @error('nik')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="text" id="form1Example23" class="form-control form-control-lg" name="nama" required />
            <label class="form-label" for="form1Example23">Nama</label>
            @error('nama')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Username input -->
          <!-- <div class="form-outline mb-4">
            <input type="text" id="form1Example24" class="form-control form-control-lg" name="username" required />
            <label class="form-label" for="form1Example24">Username</label>
          </div> -->

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="form1Example25" class="form-control form-control-lg" name="password" required />
            <label class="form-label" for="form1Example25">Password</label>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Confirm Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="form1Example26" class="form-control form-control-lg" name="password_confirmation" required />
            <label class="form-label" for="form1Example26">Konfirmasi Password</label>
            @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- No Telepon input -->
          <div class="form-outline mb-4">
            <input type="text" id="form1Example27" class="form-control form-control-lg" name="no_telepon" required />
            <label class="form-label" for="form1Example27">No. Telepon</label>
            @error('no_telepon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block w-100 mb-4">Daftar</button>

          <p class="text-center">Sudah punya akun <a href="{{ route('login') }}">Login</a></p>
        </form>
      </div>
    </div>
  </div>
</section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>