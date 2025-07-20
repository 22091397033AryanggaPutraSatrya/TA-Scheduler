<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil data pengguna yang sedang login
        $user = Auth::user();

        // 3. Periksa apakah peran pengguna cocok dengan salah satu peran yang diizinkan
        foreach ($roles as $role) {
            if ($user->role === $role) {
                // Jika cocok, izinkan akses ke halaman berikutnya
                return $next($request);
            }
        }

        // 4. Jika tidak ada peran yang cocok, tolak akses
        abort(403, 'ANDA TIDAK MEMILIKI HAK AKSES UNTUK HALAMAN INI.');
    }
}