@extends('layouts.app')
@section('title', 'Satu Untuk Nusantara - Mendukung UMKM Indonesia')

@section('content')
<!-- HERO -->
<section class="hero">
<div class="container">
<div class="row align-items-center">
<div class="col-md-6">
<h1>Mendukung UMKM Indonesia<br>Menuju Pasar Digital Nasional</h1>
<p>Platform yang menghubungkan UMKM Indonesia dengan pelanggan melalui toko digital, promosi, QR Store, dan jaringan bisnis antar UMKM.</p>
<div class="d-flex gap-3 flex-wrap">
<a href="{{ route('umkm.index') }}" class="btn-outline-white">Jelajahi UMKM</a>
<a href="{{ route('register') }}" class="btn-red">Daftar Sebagai UMKM</a>
</div>
</div>
<div class="col-md-6 d-none d-md-block">
<div class="hero-image">
<img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80" alt="Produk UMKM Indonesia" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
</div>
</div>
</div>
</div>
</section>

<!-- UMKM UNGGULAN -->
<section class="bg-light">
<div class="container">
<div class="section-title">UMKM Unggulan</div>
<div class="section-subtitle">Temukan produk terbaik dari UMKM Indonesia</div>
<div class="row g-4">
@forelse($stores as $store)
<div class="col-md-4">
<div class="card-store">
<div style="position:relative;">
@if($store->logo)
<img src="{{ asset($store->logo) }}" alt="{{ $store->name }}">
@else
<img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=80" alt="{{ $store->name }}" style="width:100%;height:200px;object-fit:cover;">
@endif
<span class="badge-cat" style="position:absolute;top:12px;left:12px;">{{ $store->category }}</span>
</div>
<div class="card-body">
<h5>{{ $store->name }}</h5>
<p>{{ $store->description ? Str::limit($store->description, 80) : 'Toko UMKM pilihan dari seluruh Nusantara' }}</p>
<a href="{{ route('umkm.show', $store->id) }}" class="btn-red" style="font-size:0.88rem;padding:8px 20px;">Lihat Toko</a>
</div>
</div>
</div>
@empty
<div class="col-12 text-center text-muted py-4">Belum ada UMKM terdaftar.</div>
@endforelse
</div>
</div>
</section>

<!-- PROMO TERBARU -->
<section>
<div class="container">
<div class="section-title">Promo Terbaru</div>
<div class="section-subtitle">Penawaran spesial dari UMKM terpilih</div>
<div class="row g-4">
@forelse($promos as $promo)
<div class="col-md-4">
<div class="card-promo">
@if($promo->banner)
<img src="{{ asset($promo->banner) }}" alt="{{ $promo->title }}" style="width:100%;height:160px;object-fit:cover;">
@else
<div style="height:160px;overflow:hidden;">
@php
$promoImages = [
    'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400&q=80',
    'https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=400&q=80',
    'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&q=80',
];
$imgIdx = $loop->index % 3;
@endphp
<img src="{{ $promoImages[$imgIdx] }}" alt="{{ $promo->title }}" style="width:100%;height:160px;object-fit:cover;">
</div>
@endif
<div class="promo-body">
<div class="d-flex justify-content-between align-items-start mb-2">
<div>
<h5>{{ $promo->title }}</h5>
<div class="promo-from">{{ $promo->store->name ?? 'UMKM Terpilih' }}</div>
</div>
</div>
<p class="promo-desc">Dapatkan penawaran terbaik untuk produk pilihan UMKM lokal Indonesia.</p>
@if($promo->code)
<div class="d-flex align-items-center gap-3 mb-3">
<span class="promo-code">{{ $promo->code }}</span>
<span style="color:#888;font-size:0.8rem;">Kode Promo</span>
</div>
@endif
<a href="{{ route('promo.index') }}" class="btn-red" style="font-size:0.85rem;padding:8px 18px;">Lihat Promo</a>
</div>
</div>
</div>
@empty
<div class="col-12 text-center text-muted py-4">Belum ada promo tersedia.</div>
@endforelse
</div>
</div>
</section>

<!-- ABOUT STATS -->
<section class="about-section">
<div class="container">
<div class="row g-4 align-items-center">
<div class="col-md-6">
<h2 style="font-size:1.8rem;font-weight:700;margin-bottom:16px;">Tentang Satu Untuk Nusantara</h2>
<p style="opacity:0.88;line-height:1.8;">Kami hadir untuk mendukung pertumbuhan UMKM Indonesia di era digital. Misi kami adalah menghubungkan pelaku UMKM dengan pelanggan di seluruh Nusantara melalui platform yang mudah digunakan, terjangkau, dan inovatif.</p>
</div>
<div class="col-md-6">
<div class="row g-3 text-center">
<div class="col-6">
<span class="stat-number">500+</span>
<span class="stat-label">UMKM</span>
</div>
<div class="col-6">
<span class="stat-number">10.000+</span>
<span class="stat-label">Produk</span>
</div>
<div class="col-6">
<span class="stat-number">50+</span>
<span class="stat-label">Kota</span>
</div>
<div class="col-6">
<span class="stat-number">5.000+</span>
<span class="stat-label">Pelanggan</span>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection