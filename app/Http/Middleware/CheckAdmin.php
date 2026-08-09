<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     * Memeriksa apakah user yang sedang masuk memiliki role admin.
     * Jika bukan admin, akses ditolak dan diarahkan ke halaman utama.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('user_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}
