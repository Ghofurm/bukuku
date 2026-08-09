<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Menampilkan daftar semua user beserta statistik jumlah review di panel admin.
     */
    public function index()
    {
        // Ambil semua user dengan hitungan relasi reviews
        $users = User::withCount('reviews')->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menghapus user tertentu dari database.
     * Mencegah admin menghapus dirinya sendiri demi keamanan.
     */
    public function destroy(User $user)
    {
        if ($user->id === session('user_id')) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
