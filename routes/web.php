<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminGenreController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

/**
 * Route untuk Autentikasi (Publik / tidak butuh login)
 */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Route untuk Ganti Password (Wajib login / middleware check.login)
 */
Route::middleware('check.login')->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])
        ->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('change-password.submit');
});

/**
 * Route Halaman Publik (Dapat diakses tanpa login)
 */
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

/**
 * Route Fitur User (Wajib login / middleware check.login)
 */
Route::middleware('check.login')->group(function () {
    // Profil user & rak buku
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Review (store / update / destroy)
    Route::resource('reviews', ReviewController::class)->only(['store', 'update', 'destroy']);

    // Rak buku (tambah / hapus / ganti status)
    Route::post('/books/{book}/shelf', [BookshelfController::class, 'store'])
        ->name('bookshelf.store');
    Route::delete('/books/{book}/shelf', [BookshelfController::class, 'destroy'])
        ->name('bookshelf.destroy');
});

/**
 * Route Khusus Admin (Wajib login & admin / middleware check.login + check.admin)
 */
Route::middleware(['check.login', 'check.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('books', AdminBookController::class);
        Route::resource('genres', AdminGenreController::class);
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');
    });
