<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user yang sedang login.
     * Memuat data diri user beserta daftar rak buku miliknya,
     * dikelompokkan berdasarkan status: 'reading', 'want_to_read', dan 'read'.
     */
    public function index()
    {
        // Ambil data user beserta relasi buku di rak
        $user = User::with('bookshelves.book.genre')->findOrFail(session('user_id'));

        // Kelompokkan data rak buku berdasarkan status
        $reading = $user->bookshelves->where('status', 'reading');
        $wantToRead = $user->bookshelves->where('status', 'want_to_read');
        $read = $user->bookshelves->where('status', 'read');

        return view('profile.index', compact('user', 'reading', 'wantToRead', 'read'));
    }
}
