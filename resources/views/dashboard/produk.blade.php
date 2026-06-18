@extends('layouts.dashboard')
@section('title', 'Kelola Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-2">
    <div>
        <div class="dash-title">Kelola Produk</div>
        <div class="dash-subtitle">Tambah, edit, dan hapus produk toko Anda</div>
    </div>
    <button class="btn-add" onclick="openModal('addModal')">+ Tambah Produk</button>
</div>

<!-- SEARCH -->
<form method="GET" class="mb-4">
    <div class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="🔍 Cari produk..." value="{{ request('search') }}" style="max-width:300px;">
        <button type="submit" class="btn-save">Cari</button>
    </div>
</form>

<!-- TABLE -->
<div class="table-card">
    <div class="table-header">Daftar Produk</div>
    <div style="overflow-x:auto;">
        <table class="prod-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Link Sosial Media</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->photo)
                            <img src="{{ asset($product->photo) }}" alt="" class="prod-img">
                        @else
                            <div class="prod-img" style="background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">🍽️</div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $product->name }}</td>
                    <td><span class="badge-cat">{{ $product->category }}</span></td>
                    <td class="price-col">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="link-col">{{ $product->social_link ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn-edit" onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->category }}', {{ $product->price }}, '{{ addslashes($product->description ?? '') }}', '{{ $product->social_link ?? '' }}')">Edit</button>
                            <form action="{{ route('dashboard.produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#aaa;padding:28px;">Belum ada produk. Klik "+ Tambah Produk" untuk menambahkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD MODAL -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <h5>Tambah Produk Baru</h5>
        <form action="{{ route('dashboard.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama produk" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-control">
                        @foreach(['Makanan','Minuman','Fashion','Kerajinan','Kesehatan','Lainnya'] as $k)
                            <option value="{{ $k }}">{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" placeholder="0" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link Sosial Media</label>
                    <input type="text" name="social_link" class="form-control" placeholder="@username/produk">
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi produk..."></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-save">Simpan Produk</button>
                <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <h5>Edit Produk</h5>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="category" id="editCategory" class="form-control">
                        @foreach(['Makanan','Minuman','Fashion','Kerajinan','Kesehatan','Lainnya'] as $k)
                            <option value="{{ $k }}">{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" id="editPrice" class="form-control" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link Sosial Media</label>
                    <input type="text" name="social_link" id="editLink" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" id="editDesc" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Foto Produk (opsional)</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-save">Simpan</button>
                <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openModal(id) { document.getElementById(id).classList.add('show'); }
function closeModal(id) { document.getElementById(id).classList.remove('show'); }

const produkBaseUrl = '{{ url("dashboard/produk") }}';
function openEditModal(id, name, cat, price, desc, link) {
    document.getElementById('editForm').action = `${produkBaseUrl}/${id}`;
    document.getElementById('editName').value  = name;
    document.getElementById('editPrice').value = price;
    document.getElementById('editDesc').value  = desc;
    document.getElementById('editLink').value  = link;
    const sel = document.getElementById('editCategory');
    for (let o of sel.options) { if (o.value === cat) o.selected = true; }
    openModal('editModal');
}

document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('show'); });
});
</script>
@endpush
