<x-guest-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password | Tap</title>

    <!-- Forgot Password CSS -->
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-page">
        <div class="login-container">

            <!-- Header: Logo + Close -->
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="logo-img">
                </div>
                <span class="close-btn" onclick="window.location.href='/'">&times;</span>
            </div>

            <!-- Title -->
            <h2 class="login-title">Forgot Your Password?</h2>

            <!-- Message -->
            <p class="login-description">
                {{ __('No problem. Just enter your email and we’ll send you a reset link.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="form-group">
                @csrf

                <div class="form-control">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full"
                                  type="email" name="email"
                                  :value="old('email')" required
                                  autofocus placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button type="submit" class="login-btn">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</body>
</html>
</x-guest-layout>
