@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <h1>Profil: {{ $user->name }}</h1>

    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

    <p><a href="{{ route('change-password') }}">Ganti Password</a></p>

    <hr>

    <h2>Rak Buku Saya</h2>

    {{-- Buku yang Sedang Dibaca --}}
    <h3>Sedang Dibaca ({{ $reading->count() }})</h3>
    @if($reading->isEmpty())
        <p>Tidak ada buku yang sedang dibaca.</p>
    @else
        <ul>
            @foreach($reading as $shelf)
                <li>
                    <a href="{{ route('books.show', $shelf->book) }}">{{ $shelf->book->title }}</a>
                    — {{ $shelf->book->author }}
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Buku yang Ingin Dibaca --}}
    <h3>Ingin Dibaca ({{ $wantToRead->count() }})</h3>
    @if($wantToRead->isEmpty())
        <p>Tidak ada buku dalam daftar ingin dibaca.</p>
    @else
        <ul>
            @foreach($wantToRead as $shelf)
                <li>
                    <a href="{{ route('books.show', $shelf->book) }}">{{ $shelf->book->title }}</a>
                    — {{ $shelf->book->author }}
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Buku yang Sudah Dibaca --}}
    <h3>Sudah Dibaca ({{ $read->count() }})</h3>
    @if($read->isEmpty())
        <p>Tidak ada buku yang sudah selesai dibaca.</p>
    @else
        <ul>
            @foreach($read as $shelf)
                <li>
                    <a href="{{ route('books.show', $shelf->book) }}">{{ $shelf->book->title }}</a>
                    — {{ $shelf->book->author }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
