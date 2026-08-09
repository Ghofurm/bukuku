@extends('layouts.admin')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku Baru</h1>

    <a href="{{ route('admin.books.index') }}">&larr; Kembali</a>

    <br><br>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <p>
            <label for="title">Judul Buku: *</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        </p>

        <p>
            <label for="author">Penulis: *</label><br>
            <input type="text" id="author" name="author" value="{{ old('author') }}" required>
        </p>

        <p>
            <label for="genre_id">Genre: *</label><br>
            <select id="genre_id" name="genre_id" required>
                <option value="">-- Pilih Genre --</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="description">Deskripsi:</label><br>
            <textarea id="description" name="description" rows="4" cols="60">{{ old('description') }}</textarea>
        </p>

        <p>
            <label for="published_year">Tahun Terbit:</label><br>
            <input type="number" id="published_year" name="published_year" value="{{ old('published_year') }}" min="1000" max="{{ date('Y') }}">
        </p>

        <p>
            <label for="isbn">ISBN:</label><br>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}">
        </p>

        <p>
            <label for="cover_image">Cover Buku (gambar):</label><br>
            <input type="file" id="cover_image" name="cover_image" accept="image/*">
        </p>

        <p>
            <button type="submit">Simpan Buku</button>
        </p>
    </form>
@endsection
