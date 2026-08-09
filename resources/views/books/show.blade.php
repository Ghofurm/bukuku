@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container">
    <!-- Breadcrumb Navigasi -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('genres.show', $book->genre) }}">{{ $book->genre->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($book->title, 30) }}</li>
        </ol>
    </nav>

    <!-- Detail Utama Buku (2 Kolom) -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
        <div class="card-body p-4 p-md-5">
            <div class="row g-4 g-md-5">
                <!-- Kolom Kiri: Cover & Action Rak Buku -->
                <div class="col-md-4 text-center">
                    <div class="position-relative d-inline-block w-100 max-w-300">
                        @if($book->cover_image)
                            <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset('storage/' . $book->cover_image) }}"
                                 alt="{{ $book->title }}"
                                 class="img-fluid rounded-3 shadow-sm object-fit-cover w-100"
                                 style="max-width: 260px; aspect-ratio: 2/3;">
                        @else
                            <div class="rounded-3 d-flex flex-column align-items-center justify-content-center mx-auto"
                                 style="max-width: 260px; height: 360px; background-color: var(--autumn-linen); color: var(--autumn-dust);">
                                <i class="bi bi-book fs-1 mb-2"></i>
                                <span>Tanpa Sampul</span>
                            </div>
                        @endif
                    </div>

                    <!-- Panel Rak Buku (Butuh Login) -->
                    <div class="mt-4 p-3 rounded-3" style="background-color: var(--autumn-cream); border: 1px solid var(--autumn-sand);">
                        <h6 class="fw-semibold mb-3" style="color: var(--autumn-bark);">
                            <i class="bi bi-bookmark-heart me-1"></i> Rak Buku Saya
                        </h6>
                        @if(session()->has('user_id'))
                            <form action="{{ route('bookshelf.store', $book) }}" method="POST" class="mb-2">
                                @csrf
                                <div class="mb-2">
                                    <select name="status" class="form-select form-select-sm text-center">
                                        <option value="want_to_read" {{ isset($bookshelf) && $bookshelf->status === 'want_to_read' ? 'selected' : '' }}>Ingin Dibaca</option>
                                        <option value="reading" {{ isset($bookshelf) && $bookshelf->status === 'reading' ? 'selected' : '' }}>Sedang Dibaca</option>
                                        <option value="read" {{ isset($bookshelf) && $bookshelf->status === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    <i class="bi bi-check2-circle me-1"></i> Simpan ke Rak
                                </button>
                            </form>

                            @if(isset($bookshelf))
                                <form action="{{ route('bookshelf.destroy', $book) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger btn-sm p-0 text-decoration-none small">
                                        <i class="bi bi-trash me-1"></i> Hapus dari rak
                                    </button>
                                </form>
                            @endif
                        @else
                            <p class="small text-muted mb-2">Login untuk menambahkan buku ini ke rak bacaan Anda.</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">
                                Masuk ke Akun
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi & Deskripsi Buku -->
                <div class="col-md-8 d-flex flex-column">
                    <div class="mb-3">
                        <a href="{{ route('genres.show', $book->genre) }}" class="badge badge-autumn-linen text-decoration-none mb-2 fs-6">
                            {{ $book->genre->name }}
                        </a>
                        <h1 class="display-6 fw-bold mb-2" style="color: var(--autumn-bark);">
                            {{ $book->title }}
                        </h1>
                        <p class="fs-5 mb-3" style="color: var(--autumn-wood);">
                            Penulis: <span class="fw-semibold">{{ $book->author }}</span>
                        </p>
                    </div>

                    <!-- Rating Summary Box -->
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3 mb-4" style="background-color: var(--autumn-linen); max-width: 320px;">
                        <div class="display-6 fw-bold text-warning">
                            {{ number_format($book->average_rating, 1) }}
                        </div>
                        <div>
                            <div class="text-warning fs-5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($book->average_rating))
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="small text-muted font-meta">
                                Berdasarkan {{ $book->reviews->count() }} ulasan
                            </span>
                        </div>
                    </div>

                    <!-- Metadata Grid -->
                    <div class="row g-3 mb-4 text-muted small font-meta">
                        <div class="col-6 col-sm-4">
                            <span class="d-block text-uppercase extra-small text-muted">Tahun Terbit</span>
                            <strong class="text-dark fs-6">{{ $book->published_year ?? '-' }}</strong>
                        </div>
                        <div class="col-6 col-sm-4">
                            <span class="d-block text-uppercase extra-small text-muted">ISBN</span>
                            <strong class="text-dark fs-6">{{ $book->isbn ?? '-' }}</strong>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-auto">
                        <h5 class="fw-semibold mb-2" style="color: var(--autumn-bark);">Sinopsis / Deskripsi</h5>
                        <p class="lh-lg" style="color: var(--autumn-bark); font-size: 1.025rem;">
                            {{ $book->description ?: 'Belum ada deskripsi untuk buku ini.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Ulasan Pembaca -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h3 class="fw-bold mb-4" style="color: var(--autumn-bark);">
                <i class="bi bi-chat-left-quote me-2 text-warning"></i> Ulasan Pembaca ({{ $book->reviews->count() }})
            </h3>

            <!-- Form Tambah Ulasan (Untuk User Login) -->
            @if(session()->has('user_id'))
                <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px; background-color: var(--autumn-linen); border: 1px solid var(--autumn-sand) !important;">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3" style="color: var(--autumn-bark);">Tulis Ulasan Anda</h5>
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">

                            <div class="mb-3">
                                <label class="form-label">Rating Anda</label>
                                <div class="rating-select d-flex gap-2 fs-4 text-warning">
                                    <select name="rating" class="form-select form-select-sm w-auto" required>
                                        <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Bagus)</option>
                                        <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
                                        <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                                        <option value="2">⭐⭐ (2 - Kurang)</option>
                                        <option value="1">⭐ (1 - Buruk)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Komentar / Kesan Membaca</label>
                                <textarea name="comment" id="comment" rows="3" class="form-control" placeholder="Bagikan pendapat Anda mengenai buku ini..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i> Kirim Ulasan
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-secondary d-flex align-items-center justify-content-between p-3 mb-4 rounded-3" style="background-color: var(--autumn-linen); border-color: var(--autumn-sand);">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle text-primary fs-5"></i>
                        <span>Ingin menulis ulasan untuk buku ini? Silakan masuk terlebih dahulu.</span>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Masuk</a>
                </div>
            @endif

            <!-- List Ulasan -->
            @if($book->reviews->isEmpty())
                <div class="text-center py-4 text-muted">
                    <p class="mb-0">Belum ada ulasan untuk buku ini. Jadilah yang pertama memberikan penilaian!</p>
                </div>
            @else
                <div class="d-flex flex-column gap-3 mb-5">
                    @foreach($book->reviews as $review)
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; border: 1px solid var(--autumn-sand) !important;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle" style="width: 42px; height: 42px; font-size: 1.1rem;">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold" style="color: var(--autumn-bark);">{{ $review->user->name }}</h6>
                                            <small class="text-muted font-meta">{{ $review->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="text-warning small fs-6">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>

                                <p class="mb-0 mt-3" style="color: var(--autumn-bark); line-height: 1.6;">
                                    {{ $review->comment }}
                                </p>

                                <!-- Edit / Delete aksi milik sendiri -->
                                @if(session('user_id') == $review->user_id)
                                    <div class="mt-3 pt-2 border-top d-flex gap-2 justify-content-end">
                                        <button class="btn btn-link text-muted btn-sm p-0 text-decoration-none small" type="button" data-bs-toggle="collapse" data-bs-target="#editReviewForm{{ $review->id }}">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </button>
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger btn-sm p-0 text-decoration-none small ms-2">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Collapsible Form Edit Review -->
                                    <div class="collapse mt-3" id="editReviewForm{{ $review->id }}">
                                        <div class="p-3 rounded-3" style="background-color: var(--autumn-cream); border: 1px solid var(--autumn-sand);">
                                            <h6 class="fw-semibold mb-2">Edit Ulasan Anda</h6>
                                            <form action="{{ route('reviews.update', $review) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-2">
                                                    <select name="rating" class="form-select form-select-sm w-auto">
                                                        @for($r = 5; $r >= 1; $r--)
                                                            <option value="{{ $r }}" {{ $review->rating == $r ? 'selected' : '' }}>{{ $r }} Bintang</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <textarea name="comment" rows="2" class="form-control form-control-sm" required>{{ $review->comment }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm">Update Ulasan</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
