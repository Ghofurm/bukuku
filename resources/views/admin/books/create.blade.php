@extends('layouts.admin')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1" style="color: var(--autumn-bark);">Tambah Buku Baru</h1>
                <p class="text-muted small mb-0">Isi formulir untuk mengunggah buku baru ke koleksi</p>
            </div>
            <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 14px; border: 1px solid var(--autumn-sand) !important; background-color: var(--autumn-white);">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul lengkap buku" value="{{ old('title') }}" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="author" class="form-label">Penulis / Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="author" id="author" class="form-control" placeholder="Nama penulis" value="{{ old('author') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="genre_id" class="form-label">Genre Buku <span class="text-danger">*</span></label>
                            <select name="genre_id" id="genre_id" class="form-select" required>
                                <option value="">-- Pilih Genre --</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="published_year" class="form-label">Tahun Terbit</label>
                            <input type="number" name="published_year" id="published_year" class="form-control" placeholder="Contoh: 2024" value="{{ old('published_year') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="isbn" class="form-label">Nomor ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Contoh: 978-602-xxxx-xx-x" value="{{ old('isbn') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Foto Sampul / Cover Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maksimal 2MB.</div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Deskripsi / Sinopsis Buku</label>
                        <textarea name="description" id="description" rows="4" class="form-control" placeholder="Tuliskan gambaran umum atau sinopsis buku ini...">{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex gap-2 justify-content-end border-top pt-4">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
