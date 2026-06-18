@extends('layouts.dashboard')
@section('title', 'Daftar Teman')

@section('content')
<div class="dash-title">Daftar Teman</div>
<div class="dash-subtitle">Sesama pelaku UMKM yang sudah terhubung dengan Anda</div>

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
            <div class="num">{{ $outgoing }}</div>
            <div class="lbl">Permintaan Terkirim</div>
        </div>
    </div>
    <div class="col-md-3 col-6 d-flex align-items-center">
        <a href="{{ route('dashboard.teman') }}" class="btn-save w-100 text-center" style="text-decoration:none;padding:12px;">Cari UMKM</a>
    </div>
</div>

<!-- TABS -->
<div class="d-flex gap-3 mb-4 border-bottom">
    <button class="filter-tab active" onclick="showTab('semua')">Semua Teman</button>
    <button class="filter-tab" onclick="showTab('masuk')">Permintaan Masuk ({{ $incoming->count() }})</button>
</div>

<!-- ALL FRIENDS -->
<div id="tab-semua">
    <h5 style="font-weight:700;margin-bottom:16px;">Teman UMKM Saya</h5>
    <div class="row g-3">
        @forelse($accepted as $f)
        @php $friend = $f->user_id == $userId ? $f->friendUser : $f->user; @endphp
        <div class="col-md-3 col-6">
            <div class="friend-card">
                @if($friend->store)
                    <span style="background:#f5f5f5;color:#555;font-size:0.72rem;padding:3px 10px;border-radius:20px;display:inline-block;margin-bottom:8px;">{{ $friend->store->category }}</span>
                @endif
                <div class="friend-avatar">{{ strtoupper(substr($friend->name, 0, 1)) }}</div>
                <div class="f-name">{{ $friend->store->name ?? $friend->name }}</div>
                <div class="f-location">📍 {{ $friend->store->city ?? '-' }}</div>
                <div class="d-flex gap-2 mt-2">
                    @if($friend->store)
                    <a href="{{ route('umkm.show', $friend->store->id) }}" class="btn-save" style="flex:1;text-align:center;padding:7px;font-size:0.82rem;text-decoration:none;">Lihat Profil</a>
                    @else
                    <span class="btn-save" style="flex:1;text-align:center;padding:7px;font-size:0.82rem;opacity:0.5;cursor:not-allowed;">Lihat Profil</span>
                    @endif
                    <form action="{{ route('dashboard.teman.remove', $friend->id) }}" method="POST" onsubmit="return confirm('Hapus teman ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-cancel" style="padding:7px 12px;font-size:0.82rem;">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-muted text-center py-4">Belum ada teman terhubung.</div>
        @endforelse
    </div>
</div>

<!-- INCOMING REQUESTS -->
<div id="tab-masuk" style="display:none;">
    <h5 style="font-weight:700;margin-bottom:16px;">Permintaan Masuk</h5>
    <div class="row g-3">
        @forelse($incoming as $req)
        <div class="col-md-3 col-6">
            <div class="friend-card">
                <div class="friend-avatar">{{ strtoupper(substr($req->user->name, 0, 1)) }}</div>
                <div class="f-name">{{ $req->user->store->name ?? $req->user->name }}</div>
                <div class="f-location">📍 {{ $req->user->store->city ?? '-' }}</div>
                <div class="d-flex gap-2 mt-2">
                    <form action="{{ route('dashboard.teman.accept', $req->user->id) }}" method="POST" style="flex:1;">
                        @csrf
                        <button type="submit" class="btn-save w-100" style="font-size:0.82rem;padding:7px;">✓ Terima</button>
                    </form>
                    <form action="{{ route('dashboard.teman.remove', $req->user->id) }}" method="POST" onsubmit="return confirm('Tolak permintaan?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-cancel" style="padding:7px 10px;font-size:0.82rem;">✗</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-muted text-center py-4">Tidak ada permintaan masuk.</div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
function showTab(tab) {
    document.getElementById('tab-semua').style.display = tab === 'semua' ? '' : 'none';
    document.getElementById('tab-masuk').style.display  = tab === 'masuk'  ? '' : 'none';
    document.querySelectorAll('.filter-tab').forEach((t,i) => {
        t.classList.toggle('active', (i === 0 && tab === 'semua') || (i === 1 && tab === 'masuk'));
    });
}
</script>
@endpush
