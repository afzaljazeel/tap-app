<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tourist;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone_number' => ['required', 'string', 'max:20'],
        'nationality' => ['nullable', 'string', 'max:100'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => 'tourist', // default role
        'password' => Hash::make($request->password),
    ]);

    Tourist::create([
        'user_id' => $user->id,
        'phone' => $request->phone_number,
        'nationality' => $request->nationality,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return $this->redirectToRole(Auth::user());
}

// Custom redirect logic
protected function redirectToRole($user)
{
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'guide') {
        return redirect()->route('guide.dashboard');
    } else {
        return redirect()->route('home');
    }
}
}