@extends('layouts.app')

@section('title', 'Genre: ' . $genre->name)

@section('content')
    <h1>Genre: {{ $genre->name }}</h1>

    <p><a href="{{ route('home') }}">&larr; Semua Genre</a></p>

    @if($books->isEmpty())
        <p>Belum ada buku dalam genre ini.</p>
    @else
        <p>Menampilkan {{ $books->count() }} buku dalam genre <strong>{{ $genre->name }}</strong>.</p>
        <ul>
            @foreach($books as $book)
                <li>
                    @if($book->cover_image)
                        @if(str_starts_with($book->cover_image, 'http'))
                            <img src="{{ $book->cover_image }}" alt="Cover {{ $book->title }}" width="60">
                        @else
                            <img src="{{ Storage::url($book->cover_image) }}" alt="Cover {{ $book->title }}" width="60">
                        @endif
                    @endif

                    <strong><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a></strong><br>
                    Penulis: {{ $book->author }}<br>
                    Rating: {{ number_format($book->average_rating, 1) }} / 5
                </li>
            @endforeach
        </ul>
    @endif
@endsection
