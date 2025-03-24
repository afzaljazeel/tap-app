@extends('layouts.app')

@section('content')
    <div style="max-width: 700px; margin: 40px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 20px;">Admin Profile</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div style="margin-bottom: 15px;">
                <label for="name">Full Name</label><br>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required style="width: 100%; padding: 10px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email">Email Address</label><br>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required style="width: 100%; padding: 10px;">
            </div>

            <hr style="margin: 20px 0;">

            <div style="margin-bottom: 15px;">
                <label for="password">New Password <small>(Leave blank to keep current)</small></label><br>
                <input type="password" name="password" id="password" style="width: 100%; padding: 10px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password_confirmation">Confirm Password</label><br>
                <input type="password" name="password_confirmation" id="password_confirmation" style="width: 100%; padding: 10px;">
            </div>

            <button type="submit" style="padding: 10px 20px; background-color: #1abc9c; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Update Profile
            </button>
        </form>
    </div>
@endsection
