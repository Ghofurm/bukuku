@extends('layouts.admin')

@section('title', 'Tambah Genre')

@section('content')
    <h1>Tambah Genre Baru</h1>

    <a href="{{ route('admin.genres.index') }}">&larr; Kembali</a>

    <br><br>

    <form action="{{ route('admin.genres.store') }}" method="POST">
        @csrf

        <p>
            <label for="name">Nama Genre: *</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            <br><small>Slug akan digenerate otomatis dari nama.</small>
        </p>

        <p>
            <button type="submit">Simpan Genre</button>
        </p>
    </form>
@endsection
