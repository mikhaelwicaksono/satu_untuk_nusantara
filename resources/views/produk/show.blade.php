@extends('layouts.app')
@section('title', $product->name . ' - Satu Untuk Nusantara')

@section('content')
<div class="breadcrumb-bar">
    <div class="container">
        <a href="{{ route('home') }}">Home</a> &gt;
        <a href="{{ route('umkm.index') }}">UMKM</a> &gt;
        <a href="{{ route('umkm.show', $store->id) }}">{{ $store->name }}</a> &gt;
        <span class="current">{{ $product->name }}</span>
    </div>
</div>

<section>
    <div class="container">
        <div class="row g-5">
            <!-- LEFT: IMAGE -->
            <div class="col-md-5">
                <div class="product-main-img">
                    @if($product->photo)
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" id="mainImg">
                    @else
                        <div style="height:380px;background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-size:5rem;border-radius:12px;">🍽️</div>
                    @endif
                </div>
            </div>

            <!-- RIGHT: INFO -->
            <div class="col-md-7">
                <h1 style="font-size:1.8rem;font-weight:700;margin-bottom:8px;">{{ $product->name }}</h1>
                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="product-unit mb-3">per porsi</div>
                <hr>
                <h6 style="font-weight:700;margin-bottom:8px;">Deskripsi Produk</h6>
                <p style="color:#555;line-height:1.7;margin-bottom:20px;">{{ $product->description ?? 'Produk berkualitas dari ' . $store->name }}</p>
                <hr>
                <h6 style="font-weight:700;margin-bottom:12px;">Informasi Toko</h6>
                <div class="store-info-box mb-4">
                    <div class="s-avatar">{{ strtoupper(substr($store->name, 0, 1)) }}</div>
                    <div>
                        <div style="font-weight:700;">{{ $store->name }}</div>
                        <div style="color:#888;font-size:0.82rem;">{{ $store->category }} &bull; {{ $store->city }}</div>
                    </div>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    @if($product->social_link)
                        <a href="{{ $product->social_link }}" target="_blank" class="btn-marketplace">🛒 Kunjungi Marketplace</a>
                    @else
                        <button class="btn-marketplace">🛒 Kunjungi Marketplace</button>
                    @endif
                    <a href="{{ route('umkm.show', $store->id) }}" class="btn-hubungi">💬 Hubungi Penjual</a>
                    <button class="btn-bagikan" onclick="navigator.share ? navigator.share({title:'{{ $product->name }}',url:window.location.href}) : alert('Link disalin!')">📤 Bagikan</button>
                </div>
            </div>
        </div>

        <!-- OTHER PRODUCTS -->
        @if($others->count() > 0)
        <div class="mt-5">
            <h5 style="font-weight:700;margin-bottom:20px;">Produk Lainnya dari Toko Ini</h5>
            <div class="row g-3">
                @foreach($others as $other)
                <div class="col-md-3 col-6">
                    <div class="card-product">
                        @if($other->photo)
                            <img src="{{ asset($other->photo) }}" alt="{{ $other->name }}">
                        @else
                            <div style="height:160px;background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-size:2.5rem;">🍽️</div>
                        @endif
                        <div class="product-body">
                            <h6>{{ $other->name }}</h6>
                            <div class="price-tag">Rp {{ number_format($other->price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
