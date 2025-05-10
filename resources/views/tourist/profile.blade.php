@php
    $showSidebar = true;
    $route = Route::currentRouteName();
@endphp

@extends('layouts.tourist')

@section('title', 'Tourist Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tourist-editprofile.css') }}">

<div class="profile-header">
    <h2>My Profile</h2>
    <p class="sub-text">Your public information used during bookings.</p>
</div>

@if (session('status'))
    <div class="success-msg">{{ session('status') }}</div>
@endif

<div class="profile-card">
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="profile-section">
            <label>Full Name</label>
            <div class="editable-row">
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>
        </div>

        <div class="profile-section">
            <label>Email</label>
            <div class="editable-row">
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>
        </div>

        <!-- Toggle Password -->
        <div class="profile-section">
            <label for="togglePassword">Change Password</label>
            <div>
                <button type="button" onclick="togglePasswordFields()" class="btn-secondary small-btn">Toggle Fields</button>
            </div>
        </div>

        <div id="passwordFields" style="display: none;">
            <div class="profile-section">
                <label>New Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current">
            </div>
            <div class="profile-section">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">
            </div>
        </div>

        <hr>

        <div class="profile-section">
            <label>Nationality</label>
            <input type="text" name="nationality" value="{{ $tourist->nationality }}">
        </div>

        <div class="profile-section">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $tourist->phone }}">
        </div>

        <div class="profile-section">
            <label>Extra Notes</label>
            <textarea name="extra_notes" rows="3">{{ $tourist->extra_notes }}</textarea>
        </div>

        <button type="submit" class="btn-primary">Save Changes</button>
    </form>
</div>

<script>
    function togglePasswordFields() {
        const section = document.getElementById('passwordFields');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection
