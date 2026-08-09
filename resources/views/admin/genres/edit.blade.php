@extends('layouts.admin')

@section('title', 'Edit Genre')

@section('content')
    <h1>Edit Genre: {{ $genre->name }}</h1>

    <a href="{{ route('admin.genres.index') }}">&larr; Kembali</a>

    <br><br>

    <form action="{{ route('admin.genres.update', $genre) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="name">Nama Genre: *</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $genre->name) }}" required>
            <br><small>Slug saat ini: <strong>{{ $genre->slug }}</strong> (akan diperbarui otomatis).</small>
        </p>

        <p>
            <button type="submit">Simpan Perubahan</button>
        </p>
    </form>
@endsection
