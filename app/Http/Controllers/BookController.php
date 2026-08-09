<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku halaman utama.
     * Mendukung filter pencarian judul (?search=) dan kategori/genre (?genre_id=).
     */
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Ambil data buku beserta genrenya
        $books = $query->with('genre')->latest()->get();
        $genres = Genre::all();

        return view('books.index', compact('books', 'genres'));
    }

    /**
     * Menampilkan detail informasi sebuah buku.
     * Memuat deskripsi buku, genre, data review beserta user penulis review,
     * serta status buku di rak user jika user sudah login.
     */
    public function show(Book $book)
    {
        // Load relasi reviews beserta user-nya dan genre buku
        $book->load(['reviews.user', 'genre']);

        $bookshelf = null;
        if (session()->has('user_id')) {
            $bookshelf = $book->bookshelves()
                ->where('user_id', session('user_id'))
                ->first();
        }

        return view('books.show', compact('book', 'bookshelf'));
    }
}
