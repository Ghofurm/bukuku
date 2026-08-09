<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookshelfController extends Controller
{
    /**
     * Menambahkan buku ke rak user atau memperbarui status rak buku yang ada.
     * Status harus berupa: 'want_to_read', 'reading', atau 'read'.
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'status' => 'required|in:want_to_read,reading,read',
        ]);

        Bookshelf::updateOrCreate(
            [
                'user_id' => session('user_id'),
                'book_id' => $book->id,
            ],
            [
                'status' => $request->status,
            ]
        );

        return back()->with('success', 'Rak buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari rak user (menghapus status dari bookshelf).
     */
    public function destroy(Book $book)
    {
        Bookshelf::where('user_id', session('user_id'))
            ->where('book_id', $book->id)
            ->delete();

        return back()->with('success', 'Buku berhasil dihapus dari rak Anda.');
    }
}
