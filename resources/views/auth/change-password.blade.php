@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 col-xl-5">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="user-avatar-circle" style="width: 48px; height: 48px; font-size: 1.25rem; background-color: var(--autumn-linen); color: var(--autumn-amber);">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div>
                            <h1 class="h5 fw-bold mb-0" style="color: var(--autumn-bark);">Ganti Password</h1>
                            <p class="text-muted small mb-0">Perbarui kata sandi akun Anda demi keamanan</p>
                        </div>
                    </div>

                    <form action="{{ route('change-password.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Konfirmasi Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email akun Anda" required>
                        </div>

                        <div class="mb-3">
                            <label for="old_password" class="form-label">Password Lama</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Masukkan password saat ini" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fs-6 mb-3">
                            <i class="bi bi-check-circle me-1"></i> Simpan Password Baru
                        </button>

                        <div class="text-center">
                            <a href="{{ route('profile') }}" class="text-muted small text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Batal & Kembali ke Profil
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
