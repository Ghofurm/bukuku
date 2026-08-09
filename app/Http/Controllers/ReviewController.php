<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menyimpan review baru dari user untuk suatu buku.
     * Menerima rating (1-5) dan komentar teks opsional.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => session('user_id'),
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review Anda berhasil ditambahkan!');
    }

    /**
     * Memperbarui review yang sudah ada.
     * Hanya memperbolehkan pembaruan jika review tersebut milik user yang sedang login.
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak. Ini bukan review Anda.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review Anda berhasil diperbarui!');
    }

    /**
     * Menghapus review tertentu.
     * Hanya memperbolehkan penghapusan jika review tersebut milik user yang sedang login.
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak. Ini bukan review Anda.');
        }

        $review->delete();

        return back()->with('success', 'Review Anda berhasil dihapus.');
    }
}
