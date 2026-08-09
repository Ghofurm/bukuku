@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container">
    <!-- Profile Header Card -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-column flex-sm-row align-items-center gap-4 text-center text-sm-start">
                <!-- Avatar Circle -->
                <div class="user-avatar-circle shadow-sm" style="width: 84px; height: 84px; font-size: 2.25rem;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <!-- Info User -->
                <div class="flex-grow-1">
                    <div class="d-flex flex-column flex-sm-row align-items-center gap-2 mb-1">
                        <h1 class="h3 fw-bold mb-0" style="color: var(--autumn-bark);">{{ $user->name }}</h1>
                        @if($user->isAdmin())
                            <span class="badge badge-autumn-terracotta ms-sm-2">Administrator</span>
                        @else
                            <span class="badge badge-autumn-linen ms-sm-2">Anggota Pembaca</span>
                        @endif
                    </div>
                    <p class="text-muted mb-2 font-meta">
                        <i class="bi bi-envelope me-1"></i> {{ $user->email }}
                    </p>
                    <span class="text-muted extra-small">
                        Terdaftar sejak {{ $user->created_at ? $user->created_at->format('d M Y') : 'Baru saja' }}
                    </span>
                </div>

                <!-- Action Button -->
                <div>
                    <a href="{{ route('change-password') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-key me-1"></i> Ganti Password
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Rak Buku Saya -->
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h2 class="h4 fw-bold mb-0" style="color: var(--autumn-bark);">
            <i class="bi bi-journal-bookmark me-2 text-warning"></i> Rak Buku Saya
        </h2>
    </div>

    <!-- Tabs Navigasi Rak Buku -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
            <ul class="nav nav-tabs card-header-tabs border-bottom-0" id="bookshelfTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active d-flex align-items-center gap-2" id="reading-tab" data-bs-toggle="tab" data-bs-target="#reading" type="button" role="tab" aria-controls="reading" aria-selected="true">
                        <i class="bi bi-book-half text-warning"></i> Sedang Dibaca
                        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis ms-1">{{ $reading->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center gap-2" id="wantToRead-tab" data-bs-toggle="tab" data-bs-target="#wantToRead" type="button" role="tab" aria-controls="wantToRead" aria-selected="false">
                        <i class="bi bi-bookmark text-primary"></i> Ingin Dibaca
                        <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis ms-1">{{ $wantToRead->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center gap-2" id="read-tab" data-bs-toggle="tab" data-bs-target="#read" type="button" role="tab" aria-controls="read" aria-selected="false">
                        <i class="bi bi-check-circle text-success"></i> Sudah Dibaca
                        <span class="badge rounded-pill bg-success-subtle text-success-emphasis ms-1">{{ $read->count() }}</span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-4">
            <div class="tab-content" id="bookshelfTabContent">
                <!-- Tab Sedang Dibaca -->
                <div class="tab-pane fade show active" id="reading" role="tabpanel" aria-labelledby="reading-tab">
                    @if($reading->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-book fs-1 d-block mb-2 text-muted" style="color: var(--autumn-dust) !important;"></i>
                            <p class="mb-0">Belum ada buku yang sedang Anda baca saat ini.</p>
                            <a href="{{ route('home') }}" class="btn btn-link text-decoration-none btn-sm mt-2">Cari Buku</a>
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            @foreach($reading as $shelf)
                                <div class="col">
                                    <div class="card h-100 border-0 p-3" style="background-color: var(--autumn-cream); border: 1px solid var(--autumn-sand) !important; border-radius: 12px;">
                                        <div class="d-flex gap-3 align-items-center">
                                            @if($shelf->book->cover_image)
                                                <img src="{{ str_starts_with($shelf->book->cover_image, 'http') ? $shelf->book->cover_image : asset('storage/' . $shelf->book->cover_image) }}"
                                                     alt="{{ $shelf->book->title }}"
                                                     class="rounded shadow-sm object-fit-cover" style="width: 60px; height: 90px;">
                                            @else
                                                <div class="rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 90px; background-color: var(--autumn-linen);">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                            @endif

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h6 class="mb-1 text-truncate">
                                                    <a href="{{ route('books.show', $shelf->book) }}" class="text-decoration-none fw-semibold" style="color: var(--autumn-bark);">
                                                        {{ $shelf->book->title }}
                                                    </a>
                                                </h6>
                                                <p class="small text-muted mb-2 text-truncate">{{ $shelf->book->author }}</p>
                                                <a href="{{ route('books.show', $shelf->book) }}" class="btn btn-outline-primary btn-sm py-0 px-2 fs-7">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Tab Ingin Dibaca -->
                <div class="tab-pane fade" id="wantToRead" role="tabpanel" aria-labelledby="wantToRead-tab">
                    @if($wantToRead->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-bookmark fs-1 d-block mb-2 text-muted" style="color: var(--autumn-dust) !important;"></i>
                            <p class="mb-0">Belum ada buku dalam daftar keinginan Anda.</p>
                            <a href="{{ route('home') }}" class="btn btn-link text-decoration-none btn-sm mt-2">Cari Buku</a>
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            @foreach($wantToRead as $shelf)
                                <div class="col">
                                    <div class="card h-100 border-0 p-3" style="background-color: var(--autumn-cream); border: 1px solid var(--autumn-sand) !important; border-radius: 12px;">
                                        <div class="d-flex gap-3 align-items-center">
                                            @if($shelf->book->cover_image)
                                                <img src="{{ str_starts_with($shelf->book->cover_image, 'http') ? $shelf->book->cover_image : asset('storage/' . $shelf->book->cover_image) }}"
                                                     alt="{{ $shelf->book->title }}"
                                                     class="rounded shadow-sm object-fit-cover" style="width: 60px; height: 90px;">
                                            @else
                                                <div class="rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 90px; background-color: var(--autumn-linen);">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                            @endif

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h6 class="mb-1 text-truncate">
                                                    <a href="{{ route('books.show', $shelf->book) }}" class="text-decoration-none fw-semibold" style="color: var(--autumn-bark);">
                                                        {{ $shelf->book->title }}
                                                    </a>
                                                </h6>
                                                <p class="small text-muted mb-2 text-truncate">{{ $shelf->book->author }}</p>
                                                <a href="{{ route('books.show', $shelf->book) }}" class="btn btn-outline-primary btn-sm py-0 px-2 fs-7">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Tab Sudah Dibaca -->
                <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                    @if($read->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-check-circle fs-1 d-block mb-2 text-muted" style="color: var(--autumn-dust) !important;"></i>
                            <p class="mb-0">Belum ada buku yang selesai Anda baca.</p>
                            <a href="{{ route('home') }}" class="btn btn-link text-decoration-none btn-sm mt-2">Cari Buku</a>
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            @foreach($read as $shelf)
                                <div class="col">
                                    <div class="card h-100 border-0 p-3" style="background-color: var(--autumn-cream); border: 1px solid var(--autumn-sand) !important; border-radius: 12px;">
                                        <div class="d-flex gap-3 align-items-center">
                                            @if($shelf->book->cover_image)
                                                <img src="{{ str_starts_with($shelf->book->cover_image, 'http') ? $shelf->book->cover_image : asset('storage/' . $shelf->book->cover_image) }}"
                                                     alt="{{ $shelf->book->title }}"
                                                     class="rounded shadow-sm object-fit-cover" style="width: 60px; height: 90px;">
                                            @else
                                                <div class="rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 90px; background-color: var(--autumn-linen);">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                            @endif

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h6 class="mb-1 text-truncate">
                                                    <a href="{{ route('books.show', $shelf->book) }}" class="text-decoration-none fw-semibold" style="color: var(--autumn-bark);">
                                                        {{ $shelf->book->title }}
                                                    </a>
                                                </h6>
                                                <p class="small text-muted mb-2 text-truncate">{{ $shelf->book->author }}</p>
                                                <a href="{{ route('books.show', $shelf->book) }}" class="btn btn-outline-primary btn-sm py-0 px-2 fs-7">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
