<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Menampilkan daftar buku yang termasuk dalam genre tertentu.
     * Mengambil seluruh buku yang berelasi dengan genre yang dipilih.
     */
    public function show(Genre $genre)
    {
        // Ambil semua buku yang termasuk dalam genre ini
        $books = $genre->books()->latest()->get();

        return view('genres.show', compact('genre', 'books'));
    }
}
