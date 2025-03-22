<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Allow only admins to proceed
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        // Redirect non-admins to home with error message
        return redirect('/home')->with('error', 'Access Denied.');
    }
}
