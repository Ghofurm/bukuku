@extends('layouts.admin')

@section('title', 'Kelola Buku')

@section('content')
    <h1>Kelola Buku</h1>

    <a href="{{ route('admin.books.create') }}">+ Tambah Buku Baru</a>

    <br><br>

    @if($books->isEmpty())
        <p>Belum ada buku. <a href="{{ route('admin.books.create') }}">Tambah sekarang</a>.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Genre</th>
                    <th>Tahun</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($book->cover_image)
                                @if(str_starts_with($book->cover_image, 'http'))
                                    <img src="{{ $book->cover_image }}" alt="cover" width="40">
                                @else
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="cover" width="40">
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre->name ?? '-' }}</td>
                        <td>{{ $book->published_year ?? '-' }}</td>
                        <td>{{ number_format($book->average_rating, 1) }}</td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book) }}">Edit</a>
                            &nbsp;
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
