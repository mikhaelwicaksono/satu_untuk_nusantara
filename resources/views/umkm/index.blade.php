@extends('layouts.app')
@section('title', 'Daftar UMKM - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar UMKM Indonesia</h1>
        <p>Temukan UMKM terbaik dari seluruh penjuru nusantara</p>
    </div>
</div>

<section>
    <div class="container">
        <!-- SEARCH & FILTER -->
        <form method="GET" action="{{ route('umkm.index') }}">
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-md-4">
                    <div class="search-box">
                        <span class="search-icon">🔍</span>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama toko UMKM..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="filter-select w-100">
                        <option value="">Semua Kategori</option>
                        @foreach(['Kuliner','Fashion','Kerajinan','Minuman','Tekstil','Kesehatan'] as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="provinsi" class="filter-select w-100">
                        <option value="">Semua Provinsi</option>
                        @foreach(['Jakarta','Yogyakarta','Bandung','Aceh','Medan','Solo','Lombok','Tapanuli','Tasikmalaya','Pekanbaru'] as $prov)
                            <option value="{{ $prov }}" {{ request('provinsi') == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-red w-100">Cari</button>
                </div>
            </div>
        </form>

        <!-- GRID -->
        <div class="row g-4">
            @forelse($stores as $store)
            <div class="col-md-4">
                <div class="card-store">
                    <div style="position:relative;">
                        @if($store->logo)
                            <img src="{{ asset($store->logo) }}" alt="{{ $store->name }}">
                        @else
                            <div style="height:200px;background:linear-gradient(135deg,#f0f0f0,#e0e0e0);display:flex;align-items:center;justify-content:center;font-size:3.5rem;">🏪</div>
                        @endif
                        <span class="badge-cat" style="position:absolute;top:12px;left:12px;">{{ $store->category }}</span>
                        @if($store->city)
                            <span class="badge-location" style="position:absolute;top:12px;right:12px;">📍 {{ $store->city }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5>{{ $store->name }}</h5>
                        <p>{{ $store->description ? Str::limit($store->description, 90) : 'Toko UMKM berkualitas dari Indonesia' }}</p>
                        <a href="{{ route('umkm.show', $store->id) }}" class="btn-red" style="font-size:0.88rem;padding:8px 20px;">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="font-size:3rem;margin-bottom:14px;">🔍</div>
                <p class="text-muted">Tidak ada UMKM yang ditemukan.</p>
                <a href="{{ route('umkm.index') }}" class="btn-red">Lihat Semua UMKM</a>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
