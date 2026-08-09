@extends('layouts.admin')

@section('title', 'Kelola Buku')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Kelola Koleksi Buku</h1>
        <p class="text-muted small mb-0">Daftar seluruh buku yang terdaftar di perpustakaan Bukuku</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: var(--autumn-linen);">
                    <tr class="text-uppercase small font-meta" style="color: var(--autumn-wood);">
                        <th class="py-3 px-4" style="width: 70px;">Cover</th>
                        <th class="py-3">Judul & Penulis</th>
                        <th class="py-3">Genre</th>
                        <th class="py-3 text-center">Rating</th>
                        <th class="py-3 text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($books->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-book fs-2 d-block mb-2 text-muted" style="color: var(--autumn-dust) !important;"></i>
                                Belum ada buku yang didaftarkan.
                            </td>
                        </tr>
                    @else
                        @foreach($books as $book)
                            <tr>
                                <td class="px-4">
                                    @if($book->cover_image)
                                        <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset('storage/' . $book->cover_image) }}"
                                             alt="{{ $book->title }}"
                                             class="rounded shadow-sm object-fit-cover" style="width: 44px; height: 62px;">
                                    @else
                                        <div class="rounded d-flex align-items-center justify-content-center text-muted" style="width: 44px; height: 62px; background-color: var(--autumn-linen);">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark mb-0">{{ $book->title }}</div>
                                    <small class="text-muted"><i class="bi bi-pen me-1"></i> {{ $book->author }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-autumn-linen">
                                        {{ $book->genre->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <i class="bi bi-star-fill text-warning small"></i>
                                        <span class="fw-semibold small">{{ number_format($book->average_rating, 1) }}</span>
                                    </div>
                                </td>
                                <td class="text-end px-4">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-outline-secondary" title="Edit Buku">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Buku">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
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
