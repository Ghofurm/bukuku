@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')
    <h1>Edit Buku: {{ $book->title }}</h1>

    <a href="{{ route('admin.books.index') }}">&larr; Kembali</a>

    <br><br>

    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p>
            <label for="title">Judul Buku: *</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
        </p>

        <p>
            <label for="author">Penulis: *</label><br>
            <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
        </p>

        <p>
            <label for="genre_id">Genre: *</label><br>
            <select id="genre_id" name="genre_id" required>
                <option value="">-- Pilih Genre --</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="description">Deskripsi:</label><br>
            <textarea id="description" name="description" rows="4" cols="60">{{ old('description', $book->description) }}</textarea>
        </p>

        <p>
            <label for="published_year">Tahun Terbit:</label><br>
            <input type="number" id="published_year" name="published_year" value="{{ old('published_year', $book->published_year) }}" min="1000" max="{{ date('Y') }}">
        </p>

        <p>
            <label for="isbn">ISBN:</label><br>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
        </p>

        <p>
            <label>Cover Saat Ini:</label><br>
            @if($book->cover_image)
                @if(str_starts_with($book->cover_image, 'http'))
                    <img src="{{ $book->cover_image }}" alt="cover" width="80"><br>
                @else
                    <img src="{{ Storage::url($book->cover_image) }}" alt="cover" width="80"><br>
                @endif
            @else
                <em>Tidak ada cover</em><br>
            @endif
        </p>

        <p>
            <label for="cover_image">Ganti Cover (opsional):</label><br>
            <input type="file" id="cover_image" name="cover_image" accept="image/*">
        </p>

        <p>
            <button type="submit">Simpan Perubahan</button>
        </p>
    </form>
@endsection
