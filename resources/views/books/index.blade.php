@extends('layouts.app')

@section('title', 'Jelajahi Buku Terbaik')

@section('content')
<div class="container">
    <!-- Hero Mini -->
    <div class="card border-0 mb-5 overflow-hidden" style="background: linear-gradient(135deg, var(--autumn-cream) 0%, var(--autumn-linen) 100%); border-radius: 16px; border: 1px solid var(--autumn-sand) !important;">
        <div class="card-body p-4 p-md-5 text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="badge badge-autumn-terracotta mb-2 fs-6">
                        <i class="bi bi-book-half me-1"></i> Perpustakaan Ulasan
                    </span>
                    <h1 class="display-6 fw-bold mb-2" style="color: var(--autumn-bark);">
                        Temukan Ketenangan Dalam Setiap Bacaan
                    </h1>
                    <p class="lead mb-0" style="color: var(--autumn-wood); max-width: 540px; font-size: 1.05rem;">
                        Jelajahi berbagai koleksi buku, baca ulasan dari pembaca lain, dan simpan buku favorit Anda di rak pribadi.
                    </p>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="bi bi-journals" style="font-size: 5.5rem; color: var(--autumn-amber); opacity: 0.85;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Pencarian & Filter -->
    <div class="card border-0 shadow-sm mb-4" style="background-color: var(--autumn-white); border-radius: 12px; border: 1px solid var(--autumn-sand) !important;">
        <div class="card-body p-3 p-md-4">
            <form action="{{ route('home') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text border-end-0 bg-transparent text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari judul buku atau penulis..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="genre_id" class="form-select">
                        <option value="">-- Semua Genre --</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    @if(request('search') || request('genre_id'))
                        <a href="{{ route('home') }}" class="btn btn-secondary" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Section Title & Counter -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="h4 mb-0 fw-semibold" style="color: var(--autumn-bark);">
            @if(request('search'))
                Hasil Pencarian: "{{ request('search') }}"
            @elseif(request('genre_id'))
                Daftar Buku Genre
            @else
                Koleksi Buku
            @endif
        </h2>
        <span class="text-muted small font-meta">
            Menampilkan {{ $books->count() }} buku
        </span>
    </div>

    <!-- Grid Kartu Buku -->
    @if($books->isEmpty())
        <div class="card border-0 py-5 text-center my-4" style="background-color: var(--autumn-linen); border-radius: 12px;">
            <div class="card-body">
                <i class="bi bi-search-heart text-muted mb-3 d-block" style="font-size: 3rem; color: var(--autumn-dust) !important;"></i>
                <h5 class="fw-medium text-muted">Belum ada buku yang ditemukan</h5>
                <p class="text-muted small mb-3">Coba gunakan kata kunci lain atau pilih genre berbeda.</p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Buku</a>
            </div>
        </div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
            @foreach($books as $index => $book)
                <div class="col fade-in-up stagger-{{ ($index % 4) + 1 }}">
                    <div class="card h-100 card-hover border-0 shadow-sm overflow-hidden" style="border: 1px solid var(--autumn-sand) !important;">
                        <!-- Cover Image -->
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

                            <span class="position-absolute top-0 end-0 m-2 badge badge-autumn-linen shadow-sm">
                                {{ $book->genre->name }}
                            </span>
                        </div>

                        <!-- Card Body -->
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
</div>
@endsection
