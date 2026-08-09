@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <h1>{{ $book->title }}</h1>

    {{-- Informasi Buku --}}
    @if($book->cover_image)
        @if(str_starts_with($book->cover_image, 'http'))
            <img src="{{ $book->cover_image }}" alt="Cover {{ $book->title }}" width="150">
        @else
            <img src="{{ Storage::url($book->cover_image) }}" alt="Cover {{ $book->title }}" width="150">
        @endif
    @endif

    <p><strong>Penulis:</strong> {{ $book->author }}</p>
    <p><strong>Genre:</strong> <a href="{{ route('genres.show', $book->genre) }}">{{ $book->genre->name ?? '-' }}</a></p>
    <p><strong>Tahun Terbit:</strong> {{ $book->published_year ?? '-' }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn ?? '-' }}</p>
    <p><strong>Rating Rata-rata:</strong> {{ number_format($book->average_rating, 1) }} / 5 ({{ $book->reviews->count() }} review)</p>
    <p><strong>Deskripsi:</strong><br>{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>

    <hr>

    {{-- Kelola Rak Buku --}}
    <h2>Rak Buku Saya</h2>
    @if(session()->has('user_id'))
        @if($bookshelf)
            <p>Status di rak Anda: <strong>{{ ucfirst(str_replace('_', ' ', $bookshelf->status)) }}</strong></p>
            <form action="{{ route('bookshelf.store', $book) }}" method="POST" style="display:inline">
                @csrf
                <select name="status">
                    <option value="want_to_read" {{ $bookshelf->status === 'want_to_read' ? 'selected' : '' }}>Ingin Dibaca</option>
                    <option value="reading" {{ $bookshelf->status === 'reading' ? 'selected' : '' }}>Sedang Dibaca</option>
                    <option value="read" {{ $bookshelf->status === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                </select>
                <button type="submit">Perbarui Status</button>
            </form>
            <form action="{{ route('bookshelf.destroy', $book) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus dari rak buku?')">Hapus dari Rak</button>
            </form>
        @else
            <form action="{{ route('bookshelf.store', $book) }}" method="POST">
                @csrf
                <select name="status">
                    <option value="want_to_read">Ingin Dibaca</option>
                    <option value="reading">Sedang Dibaca</option>
                    <option value="read">Sudah Dibaca</option>
                </select>
                <button type="submit">Tambah ke Rak</button>
            </form>
        @endif
    @else
        <p><a href="{{ route('login') }}">Login</a> untuk menambahkan ke rak buku.</p>
    @endif

    <hr>

    {{-- Daftar Review --}}
    <h2>Review ({{ $book->reviews->count() }})</h2>

    @if(session()->has('user_id'))
        {{-- Form Tulis Review --}}
        <h3>Tulis Review</h3>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">

            <p>
                <label for="rating">Rating (1–5):</label>
                <select id="rating" name="rating" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </p>

            <p>
                <label for="comment">Komentar:</label><br>
                <textarea id="comment" name="comment" rows="3" cols="50">{{ old('comment') }}</textarea>
            </p>

            <button type="submit">Kirim Review</button>
        </form>
        <hr>
    @else
        <p><a href="{{ route('login') }}">Login</a> untuk menulis review.</p>
    @endif

    @if($book->reviews->isEmpty())
        <p>Belum ada review untuk buku ini. Jadilah yang pertama!</p>
    @else
        @foreach($book->reviews as $review)
            <article>
                <p>
                    <strong>{{ $review->user->name ?? 'Pengguna dihapus' }}</strong>
                    — Rating: <strong>{{ $review->rating }}/5</strong>
                    <small>({{ $review->created_at->diffForHumans() }})</small>
                </p>
                <p>{{ $review->comment ?? '(Tidak ada komentar)' }}</p>

                {{-- Tombol edit & hapus hanya muncul untuk pemilik review --}}
                @if(session('user_id') == $review->user_id)
                    <details>
                        <summary>Edit Review</summary>
                        <form action="{{ route('reviews.update', $review) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="rating" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <br>
                            <textarea name="comment" rows="2" cols="40">{{ $review->comment }}</textarea>
                            <br>
                            <button type="submit">Simpan Perubahan</button>
                        </form>
                    </details>

                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus review ini?')">Hapus Review</button>
                    </form>
                @endif
            </article>
            <hr>
        @endforeach
    @endif

    <p><a href="{{ route('home') }}">&larr; Kembali ke Daftar Buku</a></p>
@endsection
