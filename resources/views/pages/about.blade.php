@extends('layouts.app')
@section('title', 'Tentang Kami - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Tentang Satu Untuk Nusantara</h1>
        <p>Platform digital yang mendukung UMKM Indonesia</p>
    </div>
</div>

<section>
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-md-6">
                <div style="background:#f5f5f5;border-radius:16px;height:320px;display:flex;align-items:center;justify-content:center;font-size:6rem;">🤝</div>
            </div>
            <div class="col-md-6">
                <h2 style="font-weight:700;margin-bottom:16px;">Misi Kami</h2>
                <p class="about-text">Kami hadir untuk mendukung pertumbuhan UMKM Indonesia di era digital. Misi kami adalah menghubungkan pelaku UMKM dengan pelanggan di seluruh Nusantara melalui platform yang mudah digunakan, terjangkau, dan inovatif.</p>
                <p class="about-text mt-3">Platform Satu Untuk Nusantara menyediakan berbagai fitur unggulan seperti toko digital, sistem promosi, QR Store, dan jaringan bisnis antar UMKM yang membantu pelaku usaha berkembang di era digital.</p>
            </div>
        </div>

        <!-- STATS -->
        <div class="row g-4 text-center mb-5">
            @foreach([['500+','UMKM Terdaftar'],['10.000+','Produk'],['50+','Kota'],['5.000+','Pelanggan']] as $stat)
            <div class="col-md-3 col-6">
                <div style="background:#fff;border:1px solid #eee;border-radius:12px;padding:28px;">
                    <div style="font-size:2.5rem;font-weight:700;color:var(--red);">{{ $stat[0] }}</div>
                    <div style="color:#888;font-size:0.9rem;">{{ $stat[1] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- VALUES -->
        <h3 style="font-weight:700;margin-bottom:24px;">Nilai-Nilai Kami</h3>
        <div class="row g-4">
            @foreach([
                ['🎯','Fokus UMKM','Kami berkomitmen mendukung pelaku UMKM Indonesia untuk tumbuh dan berkembang.'],
                ['💡','Inovasi Digital','Memanfaatkan teknologi digital untuk mempermudah operasional dan pemasaran UMKM.'],
                ['🌐','Jangkauan Luas','Menghubungkan UMKM dengan pelanggan dari seluruh penjuru Nusantara.'],
                ['🤝','Kolaborasi','Membangun ekosistem bisnis yang saling mendukung antar pelaku UMKM.'],
            ] as $val)
            <div class="col-md-3 col-6">
                <div style="background:#fff;border:1px solid #eee;border-radius:12px;padding:24px;text-align:center;height:100%;">
                    <div style="font-size:2.5rem;margin-bottom:12px;">{{ $val[0] }}</div>
                    <h6 style="font-weight:700;margin-bottom:8px;">{{ $val[1] }}</h6>
                    <p style="color:#888;font-size:0.85rem;margin:0;">{{ $val[2] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
