<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            // If the user is authenticated, allow the request to proceed
            return $next($request);
        }

        // If not authenticated, redirect to login page
        return redirect()->route('login');
    }
}
