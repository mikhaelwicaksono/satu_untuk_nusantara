<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Satu Untuk Nusantara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div style="background:#f5f5f5;min-height:100vh;display:flex;flex-direction:column;">
    <div style="background:#fff;border-bottom:1px solid #eee;padding:14px 0;">
        <div class="container">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-2" style="text-decoration:none;">
                <img src="{{ asset('images/logo.png') }}" alt="Satu Untuk Nusantara" style="height:36px;">
                <div>
                    <div style="font-size:0.6rem;font-weight:700;color:#555;line-height:1;">SATU UNTUK</div>
                    <div style="font-size:0.9rem;font-weight:900;color:var(--red);line-height:1.2;">NUSANTARA</div>
                </div>
            </a>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-center flex-grow-1 py-5">
        <div class="auth-card">
            <div class="auth-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Satu Untuk Nusantara" style="height:52px;">
            </div>
            <h2>Daftar Akun Baru</h2>
            <p class="subtitle">Bergabunglah dengan komunitas UMKM Indonesia</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" placeholder="+62 812 3456 7890" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-red w-100" style="padding:13px;font-size:1rem;margin-top:8px;">Daftar Sekarang</button>
            </form>

            <p style="text-align:center;font-size:0.9rem;margin-top:16px;">Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a></p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
