@extends('layouts.dashboard')
@section('title', 'Kelola QR Toko')

@section('content')
<div class="dash-title">Kelola QR Toko</div>
<div class="dash-subtitle">Upload dan bagikan QR code toko Anda</div>

<div class="row g-4">
    <!-- LEFT: UPLOAD -->
    <div class="col-md-6">
        <div class="form-card">
            <h6 style="font-weight:700;margin-bottom:6px;">Upload QR Code</h6>
            <p style="color:#888;font-size:0.85rem;margin-bottom:18px;">Upload file QR code toko Anda. Format: JPG, PNG</p>

            <form action="{{ route('dashboard.qr.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="qrFileInput" class="upload-area d-block" style="cursor:pointer;">
                    <div class="upload-icon">📁</div>
                    <p>Klik atau seret file ke sini</p>
                    <p style="color:#bbb;">Format yang diterima: JPG, PNG</p>
                </label>
                <input type="file" id="qrFileInput" name="qr_image" accept="image/jpeg,image/png" style="display:none;" onchange="previewQR(this)" required>

                @if($qrCode && $qrCode->qr_image)
                <div class="file-item">
                    <span>📄 {{ basename($qrCode->qr_image) }}</span>
                </div>
                @endif

                <button type="submit" class="btn-save mt-3 w-100">⬆️ Upload QR</button>
            </form>

            @if($qrCode && $qrCode->qr_image)
            <form action="{{ route('dashboard.qr.delete') }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus QR Code?')">
                @csrf @method('DELETE')
                <button type="submit" class="delete-file" style="width:100%;padding:8px;background:#ffeaea;border:1px solid #f5c6cb;border-radius:8px;color:#c00;cursor:pointer;font-size:0.85rem;">🗑️ Hapus QR Code</button>
            </form>
            @endif
        </div>
    </div>

    <!-- RIGHT: PREVIEW + SHARE -->
    <div class="col-md-6">
        <div class="form-card">
            <h6 style="font-weight:700;margin-bottom:16px;">Preview QR Code</h6>
            <div class="qr-preview">
                @if($qrCode && $qrCode->qr_image)
                    <img src="{{ asset($qrCode->qr_image) }}" alt="QR Code" id="qrPreviewImg">
                @else
                    <div class="qr-preview-placeholder" id="qrPreviewImg">
                        <div>QR CODE</div>
                        <div style="font-size:0.75rem;color:#bbb;margin-top:4px;">Belum ada QR</div>
                    </div>
                @endif
                <div style="text-align:center;">
                    <div style="font-weight:700;">{{ $store->name }}</div>
                    <div style="color:#888;font-size:0.82rem;">Scan untuk kunjungi toko</div>
                </div>
            </div>

            <!-- LINKS -->
            <div class="mt-4">
                <h6 style="font-weight:700;margin-bottom:4px;">Link Sosial Media</h6>
                <p style="color:#888;font-size:0.82rem;margin-bottom:14px;">Masukkan link profil untuk berbagi QR code</p>
                <form action="{{ route('dashboard.qr.links') }}" method="POST">
                    @csrf
                    <div class="link-input-group">
                        <label>Link Instagram</label>
                        <input type="url" name="instagram_link" placeholder="https://www.instagram.com/tokoanda" value="{{ $qrCode->instagram_link ?? '' }}">
                    </div>
                    <div class="link-input-group">
                        <label>Link Facebook</label>
                        <input type="url" name="facebook_link" placeholder="https://www.facebook.com/tokoanda" value="{{ $qrCode->facebook_link ?? '' }}">
                    </div>
                    <button type="submit" class="btn-save w-100">💾 Simpan Link</button>
                </form>

                <div class="share-actions mt-3">
                    @if($qrCode && $qrCode->instagram_link)
                        <a href="{{ $qrCode->instagram_link }}" target="_blank" class="btn-ig">📤 Bagikan</a>
                    @else
                        <button class="btn-ig" disabled>📤 Bagikan</button>
                    @endif
                    @if($qrCode && $qrCode->qr_image)
                        <a href="{{ asset($qrCode->qr_image) }}" download class="btn-dl">⬇️ Unduh</a>
                    @else
                        <button class="btn-dl" disabled>⬇️ Unduh</button>
                    @endif
                </div>

                @if($qrCode && ($qrCode->instagram_link || $qrCode->facebook_link))
                <div class="mt-3">
                    <p style="font-weight:600;font-size:0.85rem;margin-bottom:8px;">Bagikan ke:</p>
                    <div class="d-flex gap-2">
                        @if($qrCode->instagram_link)
                            <a href="{{ $qrCode->instagram_link }}" target="_blank" class="btn-ig">Instagram</a>
                        @endif
                        @if($qrCode->facebook_link)
                            <a href="{{ $qrCode->facebook_link }}" target="_blank" class="btn-fb">Facebook</a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewQR(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const el = document.getElementById('qrPreviewImg');
            if (el.tagName === 'IMG') {
                el.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.borderRadius = '8px';
                el.replaceWith(img);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('qrFileInput').addEventListener('change', function() {
    const label = document.querySelector('.upload-area p');
    if (label && this.files[0]) label.textContent = this.files[0].name;
});
</script>
@endpush
