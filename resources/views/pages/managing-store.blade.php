@extends('layouts.app')
@section('title', 'Managing Store - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Managing Store</h1>
        <p>Kelola toko offline dan online Anda dalam satu platform terintegrasi</p>
    </div>
</div>

<div class="breadcrumb-bar">
    <div class="container">
        <a href="{{ route('home') }}">Home</a> &gt;
        <span>Services</span> &gt;
        <span class="current">Managing Store</span>
    </div>
</div>

<section>
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-md-5">
                <div style="background:#f5f5f5;border-radius:16px;height:320px;display:flex;align-items:center;justify-content:center;font-size:6rem;">🏪</div>
            </div>
            <div class="col-md-7">
                <h2 style="font-weight:700;margin-bottom:14px;">Tentang Managing Store</h2>
                <p style="color:#555;line-height:1.8;margin-bottom:14px;">Dalam website Satu untuk Nusantara, fitur manajemen toko dapat membantu pelaku UMKM mengelola toko offline maupun online dalam satu platform.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 style="font-weight:700;color:var(--red);">Untuk Toko Offline, Pelaku UMKM dapat:</h6>
                        <ul style="color:#555;font-size:0.88rem;padding-left:18px;">
                            <li>Menampilkan informasi toko fisik</li>
                            <li>Menambahkan alamat dan lokasi usaha</li>
                            <li>Menampilkan jam operasional</li>
                            <li>Menampilkan katalog produk</li>
                            <li>Menampilkan kontak</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 style="font-weight:700;color:var(--red);">Untuk Online Store, Pelaku UMKM dapat:</h6>
                        <ul style="color:#555;font-size:0.88rem;padding-left:18px;">
                            <li>Mengunggah produk secara mandiri</li>
                            <li>Mengelola stok produk</li>
                            <li>Menerima pesanan dari pelanggan</li>
                            <li>Melihat laporan penjualan</li>
                            <li>Mengelola promosi produk</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h3 style="font-weight:700;margin-bottom:24px;">Tips Mengelola Toko Offline dan Online Secara Bersamaan</h3>
        <div class="row g-4">
            @foreach([
                ['1','Gunakan Data Produk yang Sama','Pastikan nama produk, harga, deskripsi, dan stok yang ditampilkan pada toko offline dan online selalu konsisten agar tidak membingungkan pelanggan.'],
                ['2','Kelola Stok Secara Terpusat','Gunakan sistem yang memungkinkan stok produk diperbarui secara otomatis ketika terjadi transaksi, baik dari toko offline maupun online.'],
                ['3','Gunakan Foto Produk Berkualitas','Foto yang jelas dan menarik dapat meningkatkan minat beli pelanggan pada platform digital.'],
                ['4','Respon Pelanggan dengan Cepat','Pelanggan online umumnya mengharapkan balasan yang cepat. Oleh karena itu, notifikasi pesanan dan pesan pelanggan perlu dipantau secara rutin.'],
                ['5','Manfaatkan Media Sosial','Promosikan produk secara berkala melalui Instagram, Facebook, TikTok, atau WhatsApp Business untuk meningkatkan jangkauan pasar.'],
                ['6','Analisis Penjualan Secara Berkala','Lakukan evaluasi terhadap produk yang paling banyak diminati, waktu penjualan tertinggi, dan perilaku pelanggan agar strategi bisnis dapat terus ditingkatkan.'],
                ['7','Jaga Kualitas Produk dan Pelayanan','Pelanggan offline maupun online memiliki ekspektasi yang sama terhadap kualitas produk dan pelayanan. Oleh karena itu, kualitas harus selalu diprioritaskan.'],
            ] as $tip)
            <div class="col-md-6">
                <div class="tip-card">
                    <div class="tip-number">{{ $tip[0] }}</div>
                    <div>
                        <h6>{{ $tip[1] }}</h6>
                        <p>{{ $tip[2] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
