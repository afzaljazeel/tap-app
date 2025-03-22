<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
{
    // Validate login request
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Attempt login
    if (!Auth::attempt($credentials)) {
        return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
    }

    // Regenerate session
    $request->session()->regenerate();

    // Redirect user based on role
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role === 'guide') {
        return redirect()->route('guide.dashboard');
    } else {
        return redirect()->route('home'); // Default for tourists
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
