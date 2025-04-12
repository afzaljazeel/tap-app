@php
    $showSidebar = false;
@endphp

@extends('layouts.tourist')

@section('title', 'My Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tourist-profile.css') }}">

<div class="section-heading">
    <h1>My Profile</h1>
    <p>Update your personal information</p>
    <a href="{{ route('home') }}" class="btn-secondary">← Back to Home</a>
</div>

<div class="card profile-form-container">
    @if (session('status'))
        <div class="success-msg">{{ session('status') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
        @csrf
        @method('PATCH')

        <label for="name">Full Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label for="password">New Password (optional):</label>
        <input type="password" name="password" placeholder="Leave blank to keep current">

        <label for="password_confirmation">Confirm New Password:</label>
        <input type="password" name="password_confirmation">

        <label for="nationality">Nationality:</label>
        <input type="text" name="nationality" value="{{ old('nationality', $tourist->nationality) }}">

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="{{ old('phone', $tourist->phone) }}">

        <label for="extra_notes">Extra Notes:</label>
        <textarea name="extra_notes" rows="3">{{ old('extra_notes', $tourist->extra_notes) }}</textarea>

        <button type="submit" class="btn-primary">Update Profile</button>
    </form>
</div>
@endsection
