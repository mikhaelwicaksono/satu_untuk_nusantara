<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Satu Untuk Nusantara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>
<body class="dashboard-body">

<div class="dash-wrapper">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:36px;mix-blend-mode:screen;">
                <div class="sidebar-brand">
                    <div style="font-size:0.55rem;color:#aaa;line-height:1;">SATU UNTUK</div>
                    <div style="font-size:0.85rem;font-weight:900;color:#fff;line-height:1.2;">NUSANTARA</div>
                </div>
            </a>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <span class="icon">📊</span> Dashboard
            </a>
            <a href="{{ route('dashboard.toko') }}" class="{{ request()->routeIs('dashboard.toko') ? 'active' : '' }}">
                <span class="icon">🏪</span> Kelola Toko
            </a>
            <a href="{{ route('dashboard.produk') }}" class="{{ request()->routeIs('dashboard.produk') ? 'active' : '' }}">
                <span class="icon">📦</span> Kelola Produk
            </a>
            <a href="{{ route('dashboard.qr') }}" class="{{ request()->routeIs('dashboard.qr') ? 'active' : '' }}">
                <span class="icon">📱</span> Kelola QR Toko
            </a>
            <a href="{{ route('dashboard.teman') }}" class="{{ request()->routeIs('dashboard.teman') || request()->routeIs('dashboard.daftar-teman') ? 'active' : '' }}">
                <span class="icon">👥</span> Tambah Teman
            </a>
            <a href="{{ route('dashboard.promo') }}" class="{{ request()->routeIs('dashboard.promo') ? 'active' : '' }}">
                <span class="icon">🎁</span> Kelola Promo
            </a>
            <a href="{{ route('home') }}">
                <span class="icon">🌐</span> Lihat Website
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="icon">🚪</span> Keluar
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    </aside>

    <!-- MAIN -->
    <div class="dash-main">
        <!-- TOPBAR -->
        <div class="topbar">
            <div class="search-wrap">
                <input type="text" class="search-input" placeholder="Cari...">
            </div>
            <div class="user-info">
                <button class="notif-btn">🔔</button>
                <div class="avatar">{{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}</div>
                <span class="username">{{ session('user_name', 'Pelaku UMKM') }}</span>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="dash-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
