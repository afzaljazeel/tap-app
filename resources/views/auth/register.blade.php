<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign Up | Tap</title>

        <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">
    </head>
    <body>

    <div class="signup-page">
        <div class="signup-container">

            <!-- Header -->
            <div class="signup-header">
                <div class="logo-container">
                    <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="logo-img">
                </div>
                <span class="close-btn" onclick="window.location.href='/'">&times;</span>
            </div>

            <!-- Illustration -->
            <div class="signup-illustration">
                <img src="{{ asset('img/signup_img.png') }}" alt="Travel Illustration">
            </div>

            <!-- Form Section -->
            <div class="signup-form">
                <h2>Join in to Plan your<br><strong>Next Adventure</strong></h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-control">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" name="name" placeholder="Enter Full Name" required>
                    </div>

                    <!-- Email -->
                    <div class="form-control">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Enter Email" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="form-control">
                        <label for="phone_number">Phone Number</label>
                        <input id="phone_number" type="text" name="phone_number" placeholder="Enter Phone Number" required>
                    </div>

                    <!-- Nationality -->
                    <div class="form-control">
                        <label for="nationality">Nationality</label>
                        <input id="nationality" type="text" name="nationality" placeholder="Enter Nationality" required>
                    </div>

                    <!-- Password -->
                    <div class="form-control password-wrapper">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Enter Password" required>
                        <img src="{{ asset('img/eye_open.png') }}" class="toggle-password" onclick="togglePassword('password', this)">
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-control password-wrapper">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter Password" required>
                        <img src="{{ asset('img/eye_open.png') }}" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                    </div>

                    <button type="submit" class="join-btn">Join</button>

                    <div class="separator">or</div>

                    <div class="signup-footer">
                        <p class="login-redirect">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                        <div class="google-signup">
                            <span>Sign up With Google</span>
                            <img src="{{ asset('img/google_icon.webp') }}" alt="Google">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            const isVisible = field.type === 'text';
            field.type = isVisible ? 'password' : 'text';
            icon.src = isVisible ? "{{ asset('img/eye_open.png') }}" : "{{ asset('img/eye.svg') }}";
        }
    </script>
    </body>
    </html>
</x-guest-layout>
