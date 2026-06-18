@extends('layouts.dashboard')
@section('title', 'Kelola Promo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-2">
    <div>
        <div class="dash-title">Kelola Promo</div>
        <div class="dash-subtitle">Buat dan kelola promosi toko Anda</div>
    </div>
    <button class="btn-add" onclick="openModal('addPromoModal')">+ Tambah Promo</button>
</div>

<!-- STATS -->
<div class="row g-3 mb-4">
    <div class="col-md-4 col-6">
        <div class="stat-box">
            <div class="num" style="color:#333;">{{ $total }}</div>
            <div class="lbl">Total Promo</div>
        </div>
    </div>
    <div class="col-md-4 col-6">
        <div class="stat-box">
            <div class="num" style="color:#28a745;">{{ $aktif }}</div>
            <div class="lbl">Promo Aktif</div>
        </div>
    </div>
    <div class="col-md-4 col-6">
        <div class="stat-box">
            <div class="num" style="color:#ffc107;">{{ $selesai }}</div>
            <div class="lbl">Promo Berakhir</div>
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="table-card">
    <div class="table-header">Banner Promo</div>
    <div style="overflow-x:auto;">
        <table class="prod-table">
            <thead>
                <tr>
                    <th>Banner</th>
                    <th>Nama Promo</th>
                    <th>Kode</th>
                    <th>Link Promo</th>
                    <th>Berakhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promos as $promo)
                <tr>
                    <td>
                        @if($promo->banner)
                            <img src="{{ asset($promo->banner) }}" style="width:60px;height:45px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:60px;height:45px;background:#f5f5f5;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🎁</div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $promo->title }}</td>
                    <td><span class="promo-code" style="font-size:0.78rem;padding:3px 10px;">{{ $promo->code ?? '-' }}</span></td>
                    <td style="font-size:0.82rem;">
                        @if($promo->promo_link)
                            <a href="{{ $promo->promo_link }}" target="_blank" style="color:var(--red);">{{ Str::limit($promo->promo_link, 25) }}</a>
                        @else -
                        @endif
                    </td>
                    <td style="font-size:0.82rem;">{{ $promo->expires_at ? $promo->expires_at->format('d M Y') : '-' }}</td>
                    <td>
                        @if($promo->status === 'aktif')
                            <span class="badge-aktif">Aktif</span>
                        @else
                            <span class="badge-berakhir">Berakhir</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn-edit" onclick="openEditPromo({{ $promo->id }}, '{{ addslashes($promo->title) }}', '{{ $promo->code }}', '{{ $promo->promo_link }}', '{{ $promo->expires_at?->format("Y-m-d") }}', '{{ $promo->status }}')">Edit</button>
                            <form action="{{ route('dashboard.promo.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:#aaa;padding:28px;">Belum ada promo. Klik "+ Tambah Promo".</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD PROMO MODAL -->
<div class="modal-overlay" id="addPromoModal">
    <div class="modal-box">
        <h5>Tambah Promo Baru</h5>
        <form action="{{ route('dashboard.promo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Promo</label>
                    <input type="text" name="title" class="form-control" placeholder="Diskon 20% Makanan" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Promo</label>
                    <input type="text" name="code" class="form-control" placeholder="PROMO20">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link Promo</label>
                    <input type="text" name="promo_link" class="form-control" placeholder="https://...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Berakhir</label>
                    <input type="date" name="expires_at" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif">Aktif</option>
                        <option value="berakhir">Berakhir</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Banner Promo</label>
                    <input type="file" name="banner" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-save">Simpan Promo</button>
                <button type="button" class="btn-cancel" onclick="closeModal('addPromoModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT PROMO MODAL -->
<div class="modal-overlay" id="editPromoModal">
    <div class="modal-box">
        <h5>Edit Promo</h5>
        <form id="editPromoForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Promo</label>
                    <input type="text" name="title" id="epTitle" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Promo</label>
                    <input type="text" name="code" id="epCode" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link Promo</label>
                    <input type="text" name="promo_link" id="epLink" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Berakhir</label>
                    <input type="date" name="expires_at" id="epExpires" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" id="epStatus" class="form-control">
                        <option value="aktif">Aktif</option>
                        <option value="berakhir">Berakhir</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Banner Baru (opsional)</label>
                    <input type="file" name="banner" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-save">Simpan</button>
                <button type="button" class="btn-cancel" onclick="closeModal('editPromoModal')">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openModal(id) { document.getElementById(id).classList.add('show'); }
function closeModal(id) { document.getElementById(id).classList.remove('show'); }

const promoBaseUrl = '{{ url("dashboard/promo") }}';
function openEditPromo(id, title, code, link, expires, status) {
    document.getElementById('editPromoForm').action = `${promoBaseUrl}/${id}`;
    document.getElementById('epTitle').value   = title;
    document.getElementById('epCode').value    = code;
    document.getElementById('epLink').value    = link;
    document.getElementById('epExpires').value = expires;
    document.getElementById('epStatus').value  = status;
    openModal('editPromoModal');
}

document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('show'); });
});
</script>
@endpush
