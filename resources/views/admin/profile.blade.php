@extends('layouts.app')

@section('content')
    <!-- Link to the custom CSS file -->
    <link rel="stylesheet" href="{{ asset('css/admin-profile.css') }}">

    <div class="profile-container">
        <h2>Admin Profile</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div>
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
            </div>

            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
            </div>

            <hr>

            <div>
                <label for="password">New Password <small>(Leave blank to keep current)</small></label>
                <input type="password" name="password" id="password">
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
@endsection
