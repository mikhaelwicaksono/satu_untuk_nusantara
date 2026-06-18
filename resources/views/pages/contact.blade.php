@extends('layouts.app')
@section('title', 'Kontak - Satu Untuk Nusantara')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda</p>
    </div>
</div>

<section>
    <div class="container">
        <div class="row g-5">
            <div class="col-md-5">
                <h3 style="font-weight:700;margin-bottom:20px;">Informasi Kontak</h3>
                <div class="row g-3">
                    @foreach([
                        ['📍','Alamat','Jakarta, Indonesia'],
                        ['📧','Email','info@satununusantara.id'],
                        ['📞','Telepon','+62 812 3456 7890'],
                        ['📸','Instagram','@satununusantara'],
                    ] as $c)
                    <div class="col-12">
                        <div class="contact-card d-flex align-items-center gap-3" style="text-align:left;padding:18px;">
                            <span style="font-size:1.8rem;">{{ $c[0] }}</span>
                            <div>
                                <div style="font-weight:700;font-size:0.9rem;">{{ $c[1] }}</div>
                                <div style="color:#888;font-size:0.87rem;">{{ $c[2] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-7">
                <h3 style="font-weight:700;margin-bottom:20px;">Kirim Pesan</h3>
                <div style="background:#fff;border:1px solid #eee;border-radius:14px;padding:28px;">
                    @if(session('contact_sent'))
                        <div class="alert alert-success">Pesan berhasil dikirim! Kami akan segera menghubungi Anda.</div>
                    @endif
                    <form>
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" placeholder="contoh@email.com">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">Pesan</label>
                            <textarea class="form-control" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <button type="button" class="btn-red w-100" style="padding:12px;">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
