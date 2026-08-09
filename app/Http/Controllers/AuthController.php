<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     * Mengembalikan view 'auth.login'.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses permintaan login dari user.
     * Melakukan validasi email dan password, memverifikasi hash password,
     * serta menyimpan data user ke session jika login berhasil.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'user_role' => $user->role,
                'user_name' => $user->name,
            ]);

            return redirect()->route('home')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Memproses logout user.
     * Menghapus semua session dan mengarahkan kembali ke halaman login.
     */
    public function logout()
    {
        session()->flush();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Menampilkan form ganti password.
     * Hanya dapat diakses oleh user yang sudah login.
     */
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    /**
     * Memproses perubahan password user.
     * Memvalidasi data input, mencocokkan email dan password lama,
     * lalu memperbarui password dengan hash password baru.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(session('user_id'));

        if (!$user || $user->email !== $request->email || !Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Verifikasi email atau password lama salah.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password Anda berhasil diperbarui.');
    }
}
