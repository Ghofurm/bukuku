<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     * Memeriksa apakah user sudah login dengan mengecek session user_id.
     * Jika sudah login, membagikan data user ($authUser) ke seluruh view.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = User::find(session('user_id'));

        if (!$user) {
            session()->flush();
            return redirect()->route('login')->with('error', 'Sesi Anda tidak valid. Silakan login kembali.');
        }

        View::share('authUser', $user);

        return $next($request);
    }
}
