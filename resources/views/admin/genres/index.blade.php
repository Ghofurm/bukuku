@extends('layouts.admin')

@section('title', 'Kelola Genre')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Kelola Genre Buku</h1>
        <p class="text-muted small mb-0">Klasifikasi genre untuk mempermudah pencarian buku</p>
    </div>
    <a href="{{ route('admin.genres.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Genre Baru
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: var(--autumn-linen);">
                    <tr class="text-uppercase small font-meta" style="color: var(--autumn-wood);">
                        <th class="py-3 px-4">Nama Genre</th>
                        <th class="py-3">Slug / URL Segment</th>
                        <th class="py-3 text-center">Jumlah Buku</th>
                        <th class="py-3 text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($genres->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-tags fs-2 d-block mb-2 text-muted" style="color: var(--autumn-dust) !important;"></i>
                                Belum ada genre yang dibuat.
                            </td>
                        </tr>
                    @else
                        @foreach($genres as $genre)
                            <tr>
                                <td class="px-4 fw-semibold" style="color: var(--autumn-bark);">
                                    <i class="bi bi-tag me-2 text-warning"></i> {{ $genre->name }}
                                </td>
                                <td>
                                    <code class="small text-muted bg-light px-2 py-1 rounded">{{ $genre->slug }}</code>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-autumn-linen">
                                        {{ $genre->books_count ?? $genre->books()->count() }} buku
                                    </span>
                                </td>
                                <td class="text-end px-4">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-sm btn-outline-secondary" title="Edit Genre">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus genre ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Genre">
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
