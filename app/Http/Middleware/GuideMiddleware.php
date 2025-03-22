<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Allow only guides to proceed
        if (Auth::check() && Auth::user()->role === 'guide') {
            return $next($request);
        }
        
        // Redirect non-guides to home with error message
        return redirect('/home')->with('error', 'Access Denied.');
    }
}
