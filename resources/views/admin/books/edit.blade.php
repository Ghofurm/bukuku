@extends('layouts.admin')

@section('title', 'Edit Buku: ' . $book->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Edit Informasi Buku</h1>
                <p class="text-muted small mb-0">Perbarui rincian buku <strong>{{ $book->title }}</strong></p>
            </div>
            <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="author" class="form-label">Penulis / Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="genre_id" class="form-label">Genre Buku <span class="text-danger">*</span></label>
                            <select name="genre_id" id="genre_id" class="form-select" required>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="published_year" class="form-label">Tahun Terbit</label>
                            <input type="number" name="published_year" id="published_year" class="form-control" value="{{ old('published_year', $book->published_year) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="isbn" class="form-label">Nomor ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Foto Sampul / Cover Image</label>
                        @if($book->cover_image)
                            <div class="d-flex align-items-center gap-3 mb-2 p-2 rounded" style="background-color: var(--autumn-cream); border: 1px solid var(--autumn-sand);">
                                <img src="{{ str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset('storage/' . $book->cover_image) }}" alt="Sampul saat ini" class="rounded object-fit-cover" style="width: 50px; height: 70px;">
                                <div class="small text-muted">Sampul saat ini. Pilih file baru jika ingin menggantinya.</div>
                            </div>
                        @endif
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Deskripsi / Sinopsis Buku</label>
                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $book->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2 justify-content-end border-top pt-4">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Perbarui Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
