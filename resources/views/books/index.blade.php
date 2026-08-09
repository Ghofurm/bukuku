@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h1>Daftar Buku</h1>

    {{-- Form Filter & Pencarian --}}
    <form action="{{ route('home') }}" method="GET">
        <label for="search">Cari Judul:</label>
        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari judul buku...">

        <label for="genre_id">Filter Genre:</label>
        <select id="genre_id" name="genre_id">
            <option value="">-- Semua Genre --</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cari</button>
        <a href="{{ route('home') }}">Reset</a>
    </form>

    <hr>

    @if($books->isEmpty())
        <p>Tidak ada buku yang ditemukan.</p>
    @else
        <ul>
            @foreach($books as $book)
                <li>
                    {{-- Cover buku --}}
                    @if($book->cover_image)
                        @if(str_starts_with($book->cover_image, 'http'))
                            <img src="{{ $book->cover_image }}" alt="Cover {{ $book->title }}" width="60">
                        @else
                            <img src="{{ Storage::url($book->cover_image) }}" alt="Cover {{ $book->title }}" width="60">
                        @endif
                    @endif

                    <strong><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a></strong><br>
                    Penulis: {{ $book->author }}<br>
                    Genre: {{ $book->genre->name ?? '-' }}<br>
                    Rating: {{ number_format($book->average_rating, 1) }} / 5
                </li>
            @endforeach
        </ul>
    @endif
@endsection
