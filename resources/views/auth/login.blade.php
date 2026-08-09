@extends('layouts.app')

@section('title', 'Masuk ke Akun')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
                <div class="card-body p-4 p-md-5">
                    <!-- Brand Header -->
                    <div class="text-center mb-4">
                        <div class="user-avatar-circle mx-auto mb-3" style="width: 56px; height: 56px; font-size: 1.5rem; background-color: var(--autumn-linen); color: var(--autumn-amber);">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <h1 class="h4 fw-bold mb-1" style="color: var(--autumn-bark);">Selamat Datang</h1>
                        <p class="text-muted small mb-0">Masuk untuk mengelola ulasan dan rak buku Anda</p>
                    </div>

                    <!-- Form Login -->
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email / Alamat Pos-el</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" class="form-control border-start-0 ps-0" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Kata Sandi / Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fs-6 mb-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                        </button>

                        <div class="text-center">
                            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
