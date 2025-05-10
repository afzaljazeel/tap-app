<div class="admin-hero">
    <img src="{{ asset('img/hero.jpg') }}" alt="Hero Background" class="hero-img">

    <div class="hero-overlay">
        <div class="hero-title">
            <span class="hero-text">tourist</span>
            <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="hero-logo-img">
            <span class="hero-text">panel</span>
        </div>
    </div>
</div>


<link rel="stylesheet" href="{{ asset('css/tourist-modern.css') }}">

@extends('layouts.tourist')

@section('content')
    <div class="dashboard-header">
        <a href="{{ route('home') }}" class="back-btn">← Back to Home</a>
        <h1>Welcome, {{ Auth::user()->name }}</h1>
    </div>

    <div class="tour-status-tracker">
        <div class="status-card">
            <h3>{{ $pending->count() }}</h3>
            <p>Pending</p>
        </div>
        <div class="status-card">
            <h3>{{ $scheduled->count() }}</h3>
            <p>Scheduled</p>
        </div>
        <div class="status-card">
            <h3>{{ $ongoing->count() }}</h3>
            <p>Ongoing</p>
        </div>
        <div class="status-card">
            <h3>{{ $completed->count() }}</h3>
            <p>Completed</p>
        </div>
        <div class="status-card">
            <h3>{{ $cancelled->count() }}</h3>
            <p>Cancelled</p>
        </div>
    </div>

    <section class="dashboard-section activity-feed">
        <div class="activity-header">
            <h2>Recent Activity</h2>
            <a href="{{ route('tourist.mybookings') }}" class="see-more-btn">See More</a>
        </div>

        <ul class="activity-list">
            @forelse($recentBookings as $booking)
                <li class="activity-item">
                    <strong>{{ $booking->tour->name }}</strong> - Status:
                    <span class="status {{ strtolower($booking->status) }}">{{ $booking->status }}</span>
                    <small>{{ $booking->created_at->diffForHumans() }}</small>
                </li>
            @empty
                <li>No recent activity found.</li>
            @endforelse
        </ul>
    </section>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-content">
        <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="footer-logo">
        <p class="footer-slogan">Your Dream Tour, One Tap Away.</p>
        <p class="footer-contact">Contact: info@tapaguide.com</p>
        <p class="footer-rights">© 2025 Tap A Guide | All Rights Reserved</p>
    </div>
</footer>
@endsection
