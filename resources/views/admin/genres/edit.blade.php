@extends('layouts.admin')

@section('title', 'Edit Genre: ' . $genre->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Edit Genre</h1>
                <p class="text-muted small mb-0">Perbarui nama genre <strong>{{ $genre->name }}</strong></p>
            </div>
            <a href="{{ route('admin.genres.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.genres.update', $genre) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Genre <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $genre->name) }}" required>
                        <div class="form-text mt-2">Slug saat ini: <code>{{ $genre->slug }}</code> (otomatis disesuaikan jika nama diubah)</div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end border-top pt-4">
                        <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Perbarui Genre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
