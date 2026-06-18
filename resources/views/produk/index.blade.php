@extends('layouts.app')
@section('title', 'Produk - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar Produk</h1>
        <p>Temukan produk terbaik dari UMKM Indonesia</p>
    </div>
</div>

<section>
    <div class="container">
        <form method="GET" action="{{ route('produk.index') }}">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="search-box">
                        <span class="search-icon">🔍</span>
                        <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="filter-select w-100">
                        <option value="">Semua Kategori</option>
                        @foreach(['Makanan','Minuman','Fashion','Kerajinan','Kesehatan','Tekstil'] as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-red w-100">Cari</button>
                </div>
            </div>
        </form>

        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-md-3 col-6">
                <div class="card-product">
                    @if($product->photo)
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}">
                    @else
                        <div style="height:180px;background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-size:3rem;">🍽️</div>
                    @endif
                    <div class="product-body">
                        <h6>{{ $product->name }}</h6>
                        <div style="color:#888;font-size:0.78rem;margin-bottom:4px;">{{ $product->store->name ?? '' }}</div>
                        <div class="price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="{{ route('produk.show', [$product->store_id, $product->id]) }}" class="btn-red" style="font-size:0.82rem;padding:7px 16px;">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="font-size:3rem;margin-bottom:14px;">📦</div>
                <p class="text-muted">Tidak ada produk ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
