@php
    $route = Route::currentRouteName();
@endphp

@extends('layouts.admin')
@section('title', 'Admin Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-profile.css') }}">

<div class="dashboard-header">
    <h2>My Profile</h2>
</div>

@if(session('status'))
    <div class="success-message">{{ session('status') }}</div>
@endif

<div class="profile-form-card">
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Basic Info -->
        <div class="form-row">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
        </div>

        <div class="form-row">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>

        <!-- Password Section -->

        <div class="form-row">
            <span class="password-toggle" onclick="togglePasswordSection()">+ Change Password</span>
        </div>

        <div id="passwordSection" class="hidden-section">
            <div class="form-row">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-row">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
        </div>
        <button type="submit" class="btn-primary">Update Profile</button>
    </form>

    
<script>
    // Simple toggle
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.querySelector('.password-toggle');
        const section = document.getElementById('password-section');
        toggle.addEventListener('click', () => {
            section.classList.toggle('show');
        });
    });

    function togglePasswordSection() {
        const section = document.getElementById('passwordSection');
        section.classList.toggle('show');
    }
    
</script>
@endsection
