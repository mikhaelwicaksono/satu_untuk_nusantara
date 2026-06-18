@extends('layouts.app')
@section('title', 'Satu Untuk Nusantara - Mendukung UMKM Indonesia')
@section('content')

{{-- Hero Section --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Mendukung UMKM Indonesia<br>Menuju Pasar Digital Nasional</h1>
                <p>Platform yang menghubungkan UMKM Indonesia dengan pelanggan melalui toko digital, promosi, QR Store, dan jaringan bisnis antar UMKM.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('umkm.index') }}" class="btn btn-red">Jelajahi UMKM</a>
                    <a href="{{ route('register') }}" class="btn-outline-white btn">Daftar Sebagai UMKM</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80" alt="UMKM Indonesia" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                </div>
            </div>
        </div>
    </div>
</section>
	