@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Daftar Pengguna</h1>
        <p class="text-muted small mb-0">Kelola akun dan peran pengguna terdaftar di Bukuku</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: var(--autumn-linen);">
                    <tr class="text-uppercase small font-meta" style="color: var(--autumn-wood);">
                        <th class="py-3 px-4">Pengguna</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Role / Peran</th>
                        <th class="py-3 text-center">Jumlah Ulasan</th>
                        <th class="py-3 text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada pengguna terdaftar.
                            </td>
                        </tr>
                    @else
                        @foreach($users as $user)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle" style="width: 38px; height: 38px; font-size: 0.95rem;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                            @if($user->id === session('user_id'))
                                                <span class="badge bg-success-subtle text-success border border-success-subtle extra-small">Akun Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="font-meta small text-muted">
                                    {{ $user->email }}
                                </td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge badge-autumn-terracotta">
                                            <i class="bi bi-shield-check me-1"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge badge-autumn-linen">
                                            <i class="bi bi-person me-1"></i> User
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-light text-dark border">
                                        {{ $user->reviews_count ?? $user->reviews()->count() }} ulasan
                                    </span>
                                </td>
                                <td class="text-end px-4">
                                    @if($user->id !== session('user_id'))
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus User">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small fst-italic">Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
