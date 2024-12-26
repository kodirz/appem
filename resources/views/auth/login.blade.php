<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login - Pengaduan Masyarakat</title>
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
      <form action="{{ route('login') }}" method="POST">
    @csrf <!-- Token CSRF untuk keamanan -->
    
    <!-- Nama input -->
    <div class="form-outline mb-4">
        <input type="text" id="form1Example13" name="nama" class="form-control form-control-lg" required />
        <label class="form-label" for="form1Example13">Nama</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" required />
        <label class="form-label" for="form1Example23">Password</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-lg btn-block w-100 mb-4">Sign in</button>

    <div class="text-center">
        <p>Belum punya akun? <a href="{{ route('register.form') }}">Daftar sekarang</a></p>
    </div>
</form>
      </div>
    </div>
  </div>
</section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
