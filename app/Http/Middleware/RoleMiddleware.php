<?php
// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     if (!Auth::check() || Auth::user()->role !== $role) {
    //         // If the user is not authenticated or doesn't have the correct role, redirect
    //         abort(403, 'Unauthorized access');
    //     }

    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan pengguna sudah login dan memiliki salah satu role yang valid
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Jika user tidak memiliki role yang valid, berikan respons 403
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
