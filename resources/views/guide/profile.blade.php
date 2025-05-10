@php
    $showSidebar = true;
    $route = Route::currentRouteName();
@endphp

@extends('layouts.guide')

@section('title', 'My Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-editprofile.css') }}">

<div class="guide-profile-container">
    <h2 class="profile-heading">👤 My Profile</h2>

    <form method="POST" action="{{ route('guide.profile.update') }}" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('PATCH')

        <!-- User Info -->
        <div class="form-section">
            <h3>Account Info</h3>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            </div>
        </div>

        <!-- Password Toggle Section -->
        <div class="form-section">
            <h3 style="cursor: pointer;" onclick="togglePasswordFields()">🔒 Change Password <span id="toggle-icon">▼</span></h3>

            <div id="password-fields" style="display: none;">
                <div class="form-group">
                    <label for="password">New Password <small>(leave blank to keep current)</small></label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
        </div>

        <!-- Guide Info -->
        <div class="form-section">
            <h3>Guide Info</h3>

            <div class="form-group">
                <label for="certification">Certification</label>
                <input type="text" name="certification" id="certification" value="{{ $guide->certification }}">
            </div>

            <div class="form-group">
                <label for="experience">Experience (years)</label>
                <input type="text" name="experience" id="experience" value="{{ $guide->experience }}">
            </div>

            <div class="form-group">
                <label for="specialties">Specialties (comma separated)</label>
                <input type="text" name="specialties" id="specialties" value="{{ $guide->specialties }}">
            </div>
        </div>

        <button type="submit" class="btn-primary">Save Changes</button>
    </form>
</div>

<script>
    function togglePasswordFields() {
        const fields = document.getElementById('password-fields');
        const icon = document.getElementById('toggle-icon');
        fields.style.display = fields.style.display === 'none' ? 'block' : 'none';
        icon.textContent = fields.style.display === 'block' ? '▲' : '▼';
    }
</script>
@endsection
