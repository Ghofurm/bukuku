<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama admin.
     * Mengambil statistik ringkas berupa total buku, total user, dan total review.
     */
    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalReviews = Review::count();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'totalReviews'));
    }
}
