@extends('layouts.app')
@section('title', $store->name . ' - Satu Untuk Nusantara')

@section('content')
<div class="breadcrumb-bar">
    <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span> &gt; </span>
        <a href="{{ route('umkm.index') }}">UMKM</a>
        <span> &gt; </span>
        <span class="current">{{ $store->name }}</span>
    </div>
</div>

<!-- STORE HEADER -->
<div class="store-header">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-8">
                <div class="d-flex gap-4 align-items-center">
                    <div class="store-avatar">
                        @if($store->logo)
                            <img src="{{ asset($store->logo) }}" alt="{{ $store->name }}">
                        @else
                            {{ strtoupper(substr($store->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <h2 style="font-size:1.6rem;font-weight:700;margin-bottom:4px;">{{ $store->name }}</h2>
                        <div style="color:#888;font-size:0.9rem;margin-bottom:10px;">{{ $store->category }} &bull; {{ $store->city }}</div>
                        @if($store->address)
                            <div style="font-size:0.88rem;color:#555;margin-bottom:6px;">📍 {{ $store->address }}, {{ $store->city }}</div>
                        @endif
                        @if($store->phone)
                            <div style="font-size:0.88rem;color:#555;margin-bottom:6px;">📞 {{ $store->phone }}</div>
                        @endif
                        @if($store->instagram)
                            <div style="font-size:0.88rem;"><a href="#" style="color:var(--red);">{{ $store->instagram }}</a></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-3 mt-md-0">
                <a href="{{ route('umkm.qr', $store->id) }}" class="btn-scan d-block text-center text-decoration-none">📱 Scan QR</a>
                @if(session('user_id') && session('user_id') != $store->user_id)
                    <form action="{{ route('dashboard.teman.add', $store->user_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-add-friend">+ Tambah Teman</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <!-- ABOUT STORE -->
        @if($store->description)
        <div class="mb-4">
            <h5 style="font-weight:700;margin-bottom:10px;">Tentang Toko</h5>
            <p style="color:#555;line-height:1.7;">{{ $store->description }}</p>
        </div>
        @endif

        <!-- LOCATION -->
        @if($store->address)
        <div class="mb-4">
            <h5 style="font-weight:700;margin-bottom:10px;">Lokasi</h5>
            <div class="location-card">
                🗺️ <a href="https://maps.google.com/?q={{ urlencode($store->address . ', ' . $store->city) }}" target="_blank">
                    Lihat di Google Maps - {{ $store->address }}, {{ $store->city }}
                </a>
            </div>
        </div>
        @endif

        <!-- PRODUCTS -->
        <div>
            <h5 style="font-weight:700;margin-bottom:6px;">Produk Tersedia</h5>
            <p class="product-count">{{ $store->products->count() }} produk</p>
            <div class="row g-3">
                @forelse($store->products as $product)
                <div class="col-md-3 col-6">
                    <div class="card-product">
                        @if($product->photo)
                            <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}">
                        @else
                            <div style="height:180px;background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-size:3rem;">🍽️</div>
                        @endif
                        <div class="product-body">
                            <h6>{{ $product->name }}</h6>
                            <div class="price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <a href="{{ route('produk.show', [$store->id, $product->id]) }}" class="btn-red" style="font-size:0.82rem;padding:7px 16px;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-muted">Belum ada produk di toko ini.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
