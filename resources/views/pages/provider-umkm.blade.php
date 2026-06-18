@extends('layouts.app')
@section('title', 'Provider UMKM - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Provider UMKM</h1>
        <p>Pelaku usaha yang mengelola dan mempromosikan bisnisnya melalui platform Satu untuk Nusantara</p>
    </div>
</div>

<div class="breadcrumb-bar">
    <div class="container">
        <a href="{{ route('home') }}">Home</a> &gt;
        <span>Services</span> &gt;
        <span class="current">Provider UMKM</span>
    </div>
</div>

<section>
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-md-5">
                <div style="background:#f0f4ff;border-radius:16px;height:340px;display:flex;align-items:center;justify-content:center;font-size:7rem;">🏬</div>
            </div>
            <div class="col-md-7">
                <h2 style="font-weight:700;margin-bottom:14px;">Apa itu Provider UMKM?</h2>
                <p style="color:#555;line-height:1.8;margin-bottom:14px;">Provider UMKM atau Pelaku UMKM merupakan aktor utama dalam sistem Satu untuk Nusantara yang memiliki hak untuk mengelola dan mempromosikan usahanya melalui platform. Provider UMKM bertindak sebagai penyedia informasi toko, produk, dan promosi yang dapat diakses oleh pengguna lain maupun calon pelanggan.</p>
                <p style="color:#555;line-height:1.8;">Berbeda dengan Pengunjung yang hanya dapat melihat informasi UMKM, Provider UMKM memiliki akses ke fitur manajemen yang memungkinkan mereka mengelola seluruh aktivitas bisnis secara mandiri melalui dashboard sistem.</p>
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn-red" style="padding:12px 28px;">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <h3 style="font-weight:700;margin-bottom:24px;">Fitur yang Dapat Diakses Provider UMKM</h3>
        <div class="row g-4">
            @foreach([
                ['🏪','Kelola Toko','Menampilkan dan mengelola informasi toko, alamat, jam operasional, dan kontak'],
                ['📦','Kelola Produk','Mengunggah, mengedit, dan menghapus produk beserta harga dan deskripsi'],
                ['📱','Kelola QR Toko','Membuat dan membagikan QR code toko kepada pelanggan'],
                ['👥','Tambah Teman','Terhubung dengan sesama pelaku UMKM untuk membangun jaringan bisnis'],
                ['🎁','Kelola Promo','Membuat promosi dan membagikannya ke sosial media secara langsung'],
                ['📊','Dashboard','Melihat ringkasan aktivitas toko, produk aktif, dan statistik usaha'],
            ] as $feat)
            <div class="col-md-4">
                <div class="feature-card">
                    <h6><span style="font-size:1.3rem;">{{ $feat[0] }}</span> {{ $feat[1] }}</h6>
                    <p>{{ $feat[2] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
