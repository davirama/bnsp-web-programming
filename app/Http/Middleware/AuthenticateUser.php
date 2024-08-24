<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (Auth::check() && $user->role === 'siswa') {
            return $next($request);
        }
        return redirect()->back()->with('error', 'Akses Ditolak, anda bukan role siswa.');
    }
}
