@extends('layouts.app')

@section('title', 'Genre: ' . $genre->name)

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Genre: {{ $genre->name }}</li>
        </ol>
    </nav>

    <!-- Genre Header Banner -->
    <div class="card border-0 mb-5 text-center p-4 p-md-5" style="background-color: var(--autumn-linen); border-radius: 16px; border: 1px solid var(--autumn-sand) !important;">
        <div class="card-body">
            <span class="badge badge-autumn-terracotta mb-2 fs-6">Kategori Genre</span>
            <h1 class="display-6 fw-bold mb-2" style="color: var(--autumn-bark);">
                {{ $genre->name }}
            </h1>
            <p class="text-muted mb-0 font-meta">
                Menampilkan koleksi buku dalam genre <strong>{{ $genre->name }}</strong> ({{ $books->count() }} buku)
            </p>
        </div>
    </div>

    <!-- Book Grid -->
    @if($books->isEmpty())
        <div class="card border-0 py-5 text-center my-4" style="background-color: var(--autumn-white); border-radius: 12px; border: 1px solid var(--autumn-sand) !important;">
            <div class="card-body">
                <i class="bi bi-book text-muted mb-3 d-block" style="font-size: 3rem; color: var(--autumn-dust) !important;"></i>
                <h5 class="fw-medium text-muted">Belum ada buku dalam genre ini</h5>
                <p class="text-muted small mb-3">Kembali ke beranda untuk memilih genre lainnya.</p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Genre</a>
            </div>
        </div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
            @foreach($books as $index => $book)
                <div class="col fade-in-up stagger-{{ ($index % 4) + 1 }}">
                    <div class="card h-100 card-hover border-0 shadow-sm overflow-hidden" style="border: 1px solid var(--autumn-sand) !important;">
                        <div class="position-relative bg-light text-center p-3" style="height: 240px; background-color: var(--autumn-linen) !important;">
                            @if($book->cover_image)
                                <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset('storage/' . $book->cover_image) }}"
                                     alt="{{ $book->title }}"
                                     class="h-100 rounded shadow-sm object-fit-cover"
                                     style="max-width: 150px; aspect-ratio: 2/3;">
                            @else
                                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-book fs-1 mb-1" style="color: var(--autumn-dust);"></i>
                                    <span class="small font-meta">Tanpa Sampul</span>
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="h6 card-title fw-semibold text-truncate mb-1" title="{{ $book->title }}">
                                <a href="{{ route('books.show', $book) }}" class="text-decoration-none" style="color: var(--autumn-bark);">
                                    {{ $book->title }}
                                </a>
                            </h3>
                            <p class="card-subtitle small mb-3 text-truncate" style="color: var(--autumn-wood);">
                                <i class="bi bi-pen me-1"></i> {{ $book->author }}
                            </p>

                            <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-star-fill text-warning small"></i>
                                    <span class="fw-semibold small" style="color: var(--autumn-bark);">
                                        {{ number_format($book->average_rating, 1) }}
                                    </span>
                                    <span class="text-muted extra-small">/ 5</span>
                                </div>
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary py-1 px-2 fs-7">
                                    Detail <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mb-5">
        <a href="{{ route('home') }}" class="btn btn-link text-decoration-none text-muted p-0">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Semua Buku
        </a>
    </div>
</div>
@endsection
