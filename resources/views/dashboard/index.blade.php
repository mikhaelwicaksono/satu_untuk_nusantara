@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="dash-title">Selamat Datang, {{ session('user_name', 'Pelaku UMKM') }}! 👋</div>
<div class="dash-subtitle">Berikut ringkasan aktivitas toko Anda hari ini.</div>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-num">{{ $totalProducts }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon">🎁</div>
            <div class="stat-num">{{ $totalPromos }}</div>
            <div class="stat-label">Total Promo</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-num">{{ \App\Models\Friend::where(function($q){ $uid = session('user_id'); $q->where('user_id', $uid)->orWhere('friend_id', $uid); })->where('status','accepted')->count() }}</div>
            <div class="stat-label">Teman UMKM</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-icon">📱</div>
            <div class="stat-num">{{ $qrActive }}</div>
            <div class="stat-label">QR Aktif</div>
        </div>
    </div>
</div>

<!-- QUICK ACCESS -->
<div class="mb-4">
    <h5 style="font-weight:700;margin-bottom:16px;">Akses Cepat</h5>
    <div class="row g-3">
        <div class="col-md-3 col-6">
            <a href="{{ route('dashboard.toko') }}" class="quick-card">
                <div class="quick-icon">🏪</div>
                <h6>Kelola Toko</h6>
                <p>Edit informasi toko Anda</p>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('dashboard.produk') }}" class="quick-card">
                <div class="quick-icon">📦</div>
                <h6>Kelola Produk</h6>
                <p>Tambah atau edit produk</p>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('dashboard.promo') }}" class="quick-card">
                <div class="quick-icon">🎁</div>
                <h6>Kelola Promo</h6>
                <p>Buat & bagikan promo</p>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('dashboard.qr') }}" class="quick-card">
                <div class="quick-icon">📱</div>
                <h6>Kelola QR</h6>
                <p>Upload & bagikan QR toko</p>
            </a>
        </div>
    </div>
</div>

<!-- RECENT ACTIVITIES -->
<div>
    <h5 style="font-weight:700;margin-bottom:16px;">Aktivitas Terbaru</h5>
    <div class="activity-list">
        @forelse($activities as $act)
        <div class="activity-item">
            <span>• {{ $act }}</span>
            <span class="activity-time">Hari ini</span>
        </div>
        @empty
        <div class="activity-item">
            <span style="color:#aaa;">Belum ada aktivitas terbaru.</span>
        </div>
        @endforelse
    </div>
</div>
@endsection
