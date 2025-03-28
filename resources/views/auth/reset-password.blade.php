<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="auth-reset-wrapper">
        <h2>Reset Your Password</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="error-text" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="input-field" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="error-text" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
            </div>

            <div class="form-group text-right">
                <x-primary-button class="submit-btn">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
