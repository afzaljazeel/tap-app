@extends('layouts.tourist')

@section('title', 'My Bookings')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tourist-moderndash.css') }}">

<div class="dashboard-header">
<a href="{{ route('tourist.dashboard') }}" class="back-btn">← Back to Dashboard</a>
    <h1>My Bookings</h1>
    <p class="sub-text">Track your booking progress and status here.</p>
</div>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<div class="booking-list">
    @forelse ($bookings as $booking)
        <div class="card booking-track-card">
            <h3>{{ $booking->tour->name ?? 'Tour Deleted' }}</h3>
            <p><strong>Guide:</strong> {{ $booking->guide->user->name ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $booking->date }}</p>
            <p><strong>Time:</strong> {{ $booking->preferred_time }}</p>

            <div class="status-tracker">
                <span class="status-step {{ in_array($booking->status, ['Pending', 'Scheduled', 'Ongoing', 'Completed']) ? 'active' : '' }}">Pending</span>
                <span class="status-step {{ in_array($booking->status, ['Scheduled', 'Ongoing', 'Completed']) ? 'active' : '' }}">Scheduled</span>
                <span class="status-step {{ in_array($booking->status, ['Ongoing', 'Completed']) ? 'active' : '' }}">Ongoing</span>
                <span class="status-step {{ $booking->status == 'Completed' ? 'active' : '' }}">Completed</span>
                <span class="status-step {{ $booking->status == 'Cancelled' ? 'cancelled active' : '' }}">Cancelled</span>
            </div>
        </div>
    @empty
        <p class="no-bookings-msg">No bookings yet.</p>
    @endforelse
</div>

@endsection
