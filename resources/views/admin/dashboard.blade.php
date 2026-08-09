@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Dashboard Admin</h1>
        <p class="text-muted small mb-0">Ringkasan aktivitas dan data perpustakaan Bukuku</p>
    </div>
    <span class="badge badge-autumn-linen p-2 fs-7 font-meta">
        <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y') }}
    </span>
</div>

<!-- Grid Kartu Statistik -->
<div class="row g-3 g-md-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small d-block font-meta text-uppercase fw-semibold mb-1">Total Buku</span>
                    <h2 class="display-6 fw-bold mb-0" style="color: var(--autumn-bark);">{{ $totalBooks }}</h2>
                </div>
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: var(--autumn-linen); color: var(--autumn-amber); width: 56px; height: 56px;">
                    <i class="bi bi-book fs-3 leading-none"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small d-block font-meta text-uppercase fw-semibold mb-1">Total Pengguna</span>
                    <h2 class="display-6 fw-bold mb-0" style="color: var(--autumn-bark);">{{ $totalUsers }}</h2>
                </div>
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(122, 140, 110, 0.15); color: var(--autumn-sage); width: 56px; height: 56px;">
                    <i class="bi bi-people fs-3 leading-none"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small d-block font-meta text-uppercase fw-semibold mb-1">Total Ulasan</span>
                    <h2 class="display-6 fw-bold mb-0" style="color: var(--autumn-bark);">{{ $totalReviews }}</h2>
                </div>
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(184, 92, 58, 0.15); color: var(--autumn-terracotta); width: 56px; height: 56px;">
                    <i class="bi bi-chat-left-quote fs-3 leading-none"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shortcut Pintas Navigasi Admin -->
<h2 class="h5 fw-bold mb-3" style="color: var(--autumn-bark);">Navigasi Cepat</h2>
<div class="row g-3">
    <div class="col-md-4">
        <a href="{{ route('admin.books.index') }}" class="card border-0 shadow-sm text-decoration-none card-hover" style="border-radius: 12px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <i class="bi bi-journal-plus fs-2 text-warning"></i>
                <div>
                    <h6 class="fw-semibold mb-0" style="color: var(--autumn-bark);">Kelola Koleksi Buku</h6>
                    <small class="text-muted">Tambah, edit, atau hapus buku</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.genres.index') }}" class="card border-0 shadow-sm text-decoration-none card-hover" style="border-radius: 12px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <i class="bi bi-tags fs-2 text-primary"></i>
                <div>
                    <h6 class="fw-semibold mb-0" style="color: var(--autumn-bark);">Kelola Genre</h6>
                    <small class="text-muted">Kategori dan klasifikasi buku</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.users.index') }}" class="card border-0 shadow-sm text-decoration-none card-hover" style="border-radius: 12px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <i class="bi bi-person-gear fs-2 text-success"></i>
                <div>
                    <h6 class="fw-semibold mb-0" style="color: var(--autumn-bark);">Daftar Pengguna</h6>
                    <small class="text-muted">Pantau akun & ulasan user</small>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
