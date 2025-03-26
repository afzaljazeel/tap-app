<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Tap</title>

        <!-- Link CSS -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- Background -->
        <div class="login-page">
            <div class="login-container">
                <!-- Top bar: Logo left, Close right -->
                <div class="login-header">
                    <div class="logo-container">
                        <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="logo-img">
                        <span class="logo-text"></span>
                    </div>
                    <span class="close-btn" onclick="window.location.href='/'">&times;</span>
                </div>

                <!-- Welcome -->
                <h2 class="login-title">Welcome Back</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="form-group">
                    @csrf

                    <!-- Email -->
                    <div class="form-control">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block w-full"
                                      type="email" name="email"
                                      :value="old('email')" required
                                      autofocus autocomplete="username"
                                      placeholder="Enter Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-control password-wrapper">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block w-full"
                                      type="password" name="password"
                                      required autocomplete="current-password"
                                      placeholder="Enter Password" />
                        <img 
                            src="{{ asset('img/eye_open.png') }}" 
                            alt="Toggle Password" 
                            class="toggle-password eye-closed"
                            onclick="togglePassword()"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="login-btn">Sign in</button>

                    <div class="separator">
                        <span>or</span>
                    </div>

                    <!-- Register + Google -->
                    <div class="google-signin">
                        <p class="signup-link">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}">{{ __('Join') }}</a>
                        </p>
                        <span class="spacer"></span>
                        <div class="google-option">
                            <span>Sign in With Google</span>
                            <img src="{{ asset('img/google_icon.webp') }}" alt="Google Icon">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Link JS -->
        <script>
            function togglePassword() {
                const passwordField = document.getElementById("password");
                const icon = document.querySelector(".toggle-password");
                const isVisible = passwordField.type === "text";

                // Toggle input type
                passwordField.type = isVisible ? "password" : "text";

                // Toggle image source
                icon.src = isVisible 
                    ? "{{ asset('img/eye.svg') }}" 
                    : "{{ asset('img/eye_open.png') }}";

                icon.classList.toggle("eye-closed", isVisible);
                icon.classList.toggle("eye-open", !isVisible);
            }
        </script>
    </body>
    </html>
</x-guest-layout>

