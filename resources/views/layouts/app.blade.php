<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Satu Untuk Nusantara')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Satu Untuk Nusantara" class="navbar-logo">
            <div style="display:flex;flex-direction:column;line-height:1.1;">
                <span style="font-size:0.65rem;font-weight:700;color:#555;">SATU UNTUK</span>
                <span style="font-size:0.95rem;font-weight:900;color:var(--red);">NUSANTARA</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">HOME</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('umkm.*') ? 'active' : '' }}" href="{{ route('umkm.index') }}">UMKM</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">PRODUK</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('promo.*') ? 'active' : '' }}" href="{{ route('promo.index') }}">PROMO</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('about') || request()->routeIs('services.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">ABOUT</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.provider') }}">Provider UMKM</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.managing') }}">Managing Store</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">CONTACT</a></li>
                @if(session('user_id'))
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn-red" style="padding:8px 18px;font-size:0.88rem;" type="submit">Keluar</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="btn-red" style="padding:8px 18px;font-size:0.88rem;" href="{{ route('login') }}">Masuk</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>
@endif
@if(session('error'))
    <div class="container mt-3"><div class="alert alert-danger">{{ session('error') }}</div></div>
@endif

@yield('content')

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Satu Untuk Nusantara" style="height:40px;mix-blend-mode:screen;">
                    <div>
                        <div style="font-size:0.6rem;font-weight:700;color:#aaa;">SATU UNTUK</div>
                        <div style="font-size:0.85rem;font-weight:900;color:#fff;">NUSANTARA</div>
                    </div>
                </div>
                <p class="copyright">© {{ date('Y') }}. Satu Untuk Nusantara.<br>All Rights Reserved.</p>
            </div>
            <div class="col-md-2">
                <div class="footer-heading">SERVICES</div>
                <a href="{{ route('services.provider') }}">Provider UMKM</a>
                <a href="{{ route('services.managing') }}">Managing Store</a>
            </div>
            <div class="col-md-2">
                <div class="footer-heading">COMPANY</div>
                <a href="{{ route('umkm.index') }}">UMKM</a>
                <a href="{{ route('umkm.index') }}">Store</a>
                <a href="{{ route('produk.index') }}">Product</a>
            </div>
            <div class="col-md-2">
                <div class="footer-heading">ABOUT</div>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="col-md-3">
                <div class="footer-heading">SOCIAL MEDIA</div>
                <a href="#" class="social-icon">📘 Facebook</a>
                <a href="#" class="social-icon">📸 Instagram</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
