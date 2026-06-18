@extends('layouts.dashboard')
@section('title', 'Jaringan UMKM')

@section('content')
<div class="dash-title">Jaringan UMKM</div>
<div class="dash-subtitle">Temukan dan terhubung dengan sesama Pelaku UMKM Indonesia</div>

<!-- STATS -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-box">
            <div class="num">{{ $accepted->count() }}</div>
            <div class="lbl">Teman Terhubung</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-box">
            <div class="num">{{ $incoming->count() }}</div>
            <div class="lbl">Permintaan Masuk</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-box">
            <div class="num" style="color:#333;">{{ $totalUmkm }}+</div>
            <div class="lbl">Total UMKM</div>
        </div>
    </div>
    <div class="col-md-3 col-6 d-flex align-items-center">
        <a href="{{ route('dashboard.daftar-teman') }}" class="btn-save w-100 text-center" style="text-decoration:none;padding:12px;">Lihat Daftar Teman</a>
    </div>
</div>

<!-- INCOMING REQUESTS -->
@if($incoming->count() > 0)
<div class="mb-4">
    <h5 style="font-weight:700;margin-bottom:16px;">Permintaan Masuk ({{ $incoming->count() }})</h5>
    <div class="row g-3">
        @foreach($incoming as $req)
        <div class="col-md-3 col-6">
            <div class="friend-card">
                <div class="friend-avatar">{{ strtoupper(substr($req->user->name, 0, 1)) }}</div>
                <div class="f-name">{{ $req->user->name }}</div>
                <div class="f-location">{{ $req->user->store->city ?? '-' }}</div>
                <form action="{{ route('dashboard.teman.accept', $req->user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-teman" style="background:#28a745;">✓ Terima</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- SUGGESTIONS -->
<h5 style="font-weight:700;margin-bottom:16px;">UMKM yang Mungkin Anda Kenal</h5>
<div class="row g-3">
    @forelse($suggestions as $s)
    @php $friendIds = $accepted->map(fn($f) => $f->user_id == session('user_id') ? $f->friend_id : $f->user_id)->toArray(); @endphp
    <div class="col-md-3 col-6">
        <div class="friend-card">
            @if($s->store)
                <span style="background:#f5f5f5;color:#555;font-size:0.72rem;padding:3px 10px;border-radius:20px;display:inline-block;margin-bottom:8px;">{{ $s->store->category }}</span>
            @endif
            <div class="friend-avatar">{{ strtoupper(substr($s->name, 0, 1)) }}</div>
            <div class="f-name">{{ $s->store->name ?? $s->name }}</div>
            <div class="f-location">📍 {{ $s->store->city ?? '-' }}</div>
            @if(in_array($s->id, $friendIds))
                <button class="btn-teman connected">✓ Terhubung</button>
            @else
                <form action="{{ route('dashboard.teman.add', $s->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-teman">+ Tambah Teman</button>
                </form>
            @endif
        </div>
    </div>
    @empty
    <div class="col-12 text-muted text-center py-4">Tidak ada saran UMKM.</div>
    @endforelse
</div>
@endsection
