@extends('layouts.app')
@section('title', 'QR Toko ' . $store->name)

@section('content')
<div class="breadcrumb-bar">
    <div class="container">
        <a href="{{ route('home') }}">Home</a> &gt;
        <a href="{{ route('umkm.index') }}">UMKM</a> &gt;
        <a href="{{ route('umkm.show', $store->id) }}">{{ $store->name }}</a> &gt;
        <span class="current">Scan QR</span>
    </div>
</div>

<section>
    <div class="container">
        <div class="text-center mb-2">
            <h2 style="font-weight:700;">Scan QR Toko</h2>
            <div style="color:var(--red);font-weight:700;font-size:1.1rem;">{{ $store->name }}</div>
            <p class="text-muted mt-1">Scan QR code di bawah ini untuk mengunjungi toko secara langsung</p>
        </div>

        <div class="qr-wrapper">
            <div class="qr-box">
                @if($qrCode && $qrCode->qr_image)
                    <img src="{{ asset($qrCode->qr_image) }}" alt="QR Code {{ $store->name }}">
                @else
                    <div class="qr-placeholder">
                        <div style="font-size:5rem;margin-bottom:8px;">📱</div>
                        <div>QR CODE</div>
                        <div style="font-size:0.8rem;margin-top:4px;color:#bbb;">Belum ada QR Code</div>
                    </div>
                @endif
            </div>

            <h6 style="font-weight:700;margin-bottom:4px;">Bagikan QR Code:</h6>
            <div class="d-flex gap-3 flex-wrap justify-content-center">
                @if($qrCode && $qrCode->instagram_link)
                    <a href="{{ $qrCode->instagram_link }}" target="_blank" class="share-btn-ig">📸 Bagikan ke Instagram</a>
                @else
                    <button class="share-btn-ig">📸 Bagikan ke Instagram</button>
                @endif

                @if($qrCode && $qrCode->facebook_link)
                    <a href="{{ $qrCode->facebook_link }}" target="_blank" class="share-btn-fb">📘 Bagikan ke Facebook</a>
                @else
                    <button class="share-btn-fb">📘 Bagikan ke Facebook</button>
                @endif

                @if($qrCode && $qrCode->qr_image)
                    <a href="{{ asset($qrCode->qr_image) }}" download class="btn-download">⬇️ Unduh QR</a>
                @else
                    <button class="btn-download">⬇️ Unduh QR</button>
                @endif
            </div>
            <p style="color:#aaa;font-size:0.8rem;text-align:center;">* Tombol bagikan akan mengarahkan ke link sosial media yang telah diatur di Kelola QR Toko</p>
        </div>
    </div>
</section>
@endsection
