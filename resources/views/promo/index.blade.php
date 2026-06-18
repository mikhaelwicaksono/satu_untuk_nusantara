@extends('layouts.app')
@section('title', 'Promo & Penawaran Spesial - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Promo & Penawaran Spesial</h1>
        <p>Temukan penawaran terbaik dari UMKM lokal di seluruh Nusantara</p>
    </div>
</div>

<section>
    <div class="container">
        <!-- FILTER TABS -->
        <div class="filter-tabs">
            <a href="{{ route('promo.index') }}" class="filter-tab {{ !request('kategori') ? 'active' : '' }}">Semua Promo</a>
            @foreach(['Kuliner','Fashion','Kerajinan','Kesehatan'] as $kat)
                <a href="{{ route('promo.index', ['kategori' => $kat]) }}" class="filter-tab {{ request('kategori') == $kat ? 'active' : '' }}">{{ $kat }}</a>
            @endforeach
        </div>

        <!-- PROMO GRID -->
        <div class="row g-4">
            @forelse($promos as $promo)
            <div class="col-md-4">
                <div class="card-promo" style="border-radius:12px;overflow:hidden;border:1px solid #eee;">
                    @if($promo->banner)
                        <img src="{{ asset($promo->banner) }}" alt="{{ $promo->title }}" style="width:100%;height:160px;object-fit:cover;">
                    @else
                        <div style="height:160px;background:linear-gradient(135deg,#f5f5f5,#e8e8e8);display:flex;align-items:center;justify-content:center;font-size:3.5rem;">🎁</div>
                    @endif
                    <div class="promo-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5>{{ $promo->title }}</h5>
                                <div class="promo-from">{{ $promo->store->name ?? 'UMKM Terpilih' }}</div>
                            </div>
                        </div>
                        <p class="promo-desc">Klik promo untuk menuju halaman penawaran yang tersedia. Berlaku terbatas.</p>
                        @if($promo->code)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="promo-code">{{ $promo->code }}</span>
                        </div>
                        @endif
                        <div class="d-flex gap-2 align-items-center flex-wrap">
                            @if($promo->promo_link)
                                <a href="{{ $promo->promo_link }}" target="_blank" style="color:var(--red);font-size:0.85rem;font-weight:600;">🔗 Buka Link Promo →</a>
                            @else
                                <span style="color:#aaa;font-size:0.85rem;">🔗 Buka Link Promo →</span>
                            @endif
                            <button style="background:none;border:none;color:var(--red);font-size:0.85rem;cursor:pointer;" onclick="navigator.share ? navigator.share({title:'{{ $promo->title }}',text:'Promo {{ $promo->code }}',url:window.location.href}) : alert('Bagikan link ini!')">📤 Bagikan</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="font-size:3rem;margin-bottom:14px;">🎁</div>
                <p class="text-muted">Belum ada promo tersedia.</p>
            </div>
            @endforelse
        </div>

        @if($promos->count() > 0)
        <p class="text-center text-muted mt-4" style="font-size:0.85rem;">ℹ️ Klik Buka Link Promo untuk langsung diarahkan ke halaman promo yang disediakan oleh Pelaku UMKM.</p>
        @endif
    </div>
</section>
@endsection
