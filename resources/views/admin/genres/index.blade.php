@extends('layouts.admin')

@section('title', 'Kelola Genre')

@section('content')
    <h1>Kelola Genre</h1>

    <a href="{{ route('admin.genres.create') }}">+ Tambah Genre Baru</a>

    <br><br>

    @if($genres->isEmpty())
        <p>Belum ada genre.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Jumlah Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->slug }}</td>
                        <td>{{ $genre->books_count ?? $genre->books->count() }}</td>
                        <td>
                            <a href="{{ route('admin.genres.edit', $genre) }}">Edit</a>
                            &nbsp;
                            <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus genre ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
