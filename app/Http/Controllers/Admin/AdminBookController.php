<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBookController extends Controller
{
    /**
     * Menampilkan daftar semua buku di panel admin.
     */
    public function index()
    {
        $books = Book::with('genre')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Menampilkan form untuk membuat buku baru.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('admin.books.create', compact('genres'));
    }

    /**
     * Menyimpan data buku baru ke database.
     * Mengupload file cover ke storage public jika dilampirkan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048', // maks 2MB
            'genre_id' => 'required|exists:genres,id',
            'published_year' => 'nullable|integer',
            'isbn' => 'nullable|string|max:20',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk buku tertentu.
     */
    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('admin.books.edit', compact('book', 'genres'));
    }

    /**
     * Memperbarui data buku di database.
     * Menghapus file cover lama jika ada file cover baru yang diunggah.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'published_year' => 'nullable|integer',
            'isbn' => 'nullable|string|max:20',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            // Hapus file cover lama jika ada
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku dan juga file cover-nya dari storage.
     */
    public function destroy(Book $book)
    {
        // Hapus file cover dari storage jika ada
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
