@extends('layouts.dashboard')
@section('title', 'Kelola Toko')

@section('content')
<div class="dash-title">Kelola Toko</div>
<div class="dash-subtitle">Edit informasi dan tampilan toko Anda</div>

<div class="form-card">
    <form action="{{ route('dashboard.toko.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- LOGO -->
        <div class="mb-4">
            <label class="form-label">Logo Toko</label>
            <div class="d-flex align-items-center gap-4">
                <div class="logo-upload" id="logoPreview" onclick="document.getElementById('logoInput').click()">
                    @if($store->logo)
                        <img src="{{ asset($store->logo) }}" alt="Logo" id="logoImg">
                    @else
                        <div class="upload-icon">📷</div>
                        <span>Upload Logo</span>
                    @endif
                </div>
                <div>
                    <input type="file" id="logoInput" name="logo" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('logoInput').click()">Pilih File</button>
                    <div style="color:#888;font-size:0.8rem;margin-top:6px;">Format: JPG, PNG, maks. 2MB</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Nama Toko</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $store->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Alamat</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $store->address) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="category" class="form-control">
                    @foreach(['Kuliner','Fashion','Kerajinan','Minuman','Tekstil','Kesehatan','Lainnya'] as $kat)
                        <option value="{{ $kat }}" {{ old('category', $store->category) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kota / Kabupaten</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $store->city) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Deskripsi Toko</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Ceritakan tentang toko Anda...">{{ old('description', $store->description) }}</textarea>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $store->phone) }}">
                </div>
                <div>
                    <label class="form-label">Instagram / Sosial Media</label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $store->instagram) }}" placeholder="@username">
                </div>
            </div>
        </div>

        <div class="d-flex gap-3 mt-4">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="{{ route('dashboard.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('logoPreview');
            p.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
