@php
    $showSidebar = true;

    use Illuminate\Support\Carbon;

    $completedThisMonth = $completedTours->whereBetween('date', [
        Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()
    ])->count();

    $revenueThisMonth = $completedTours->whereBetween('date', [
        Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()
    ])->sum('amount');

    $upcomingCount = $upcomingTours->count();
@endphp

@extends('layouts.guide')
@section('title', 'Guide Dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<!-- Hero Section -->
<div class="admin-hero">
    <img src="{{ asset('img/hero.jpg') }}" alt="Hero Background" class="hero-img">
    <div class="hero-overlay">
        <div class="hero-title">
            <span class="hero-text">guide</span>
            <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="hero-logo-img">
            <span class="hero-text">panel</span>
        </div>
    </div>
</div>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h2>Welcome back, <span>{{ Auth::user()->name }}</span></h2>
</div>

<!-- Activity Section -->
<div class="card dashboard-activity">
    <h3>🔔 You have {{ $newRequests->count() }} new tour request(s)</h3>
    <a href="{{ route('guide.notifications') }}" class="btn-primary">View Requests</a>
</div>

<!-- Scheduled Tours Soon -->
@if($next24hrs->count())
<div class="card dashboard-activity">
    <h3>⏰ Upcoming Tour Soon</h3>
    <p>You have {{ $next24hrs->count() }} tour(s) scheduled within the next 24 hours.</p>
    <ul style="margin-top: 10px;">
        @foreach ($next24hrs as $booking)
            <li><strong>{{ $booking->tour->name }}</strong> — {{ $booking->date }} at {{ $booking->preferred_time }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Ongoing Tour -->
@if($ongoingTour)
<div class="card dashboard-activity" style="border-left: 5px solid #10b981;">
    <h3>🔄 Ongoing Tour in Progress</h3>
    <p><strong>{{ $ongoingTour->tour->name }}</strong> with <strong>{{ $ongoingTour->tourist->name }}</strong></p>
    <p>Date: {{ $ongoingTour->date }} | Time: {{ $ongoingTour->preferred_time }}</p>
    <a href="{{ route('guide.calendar') }}" class="btn-primary" style="margin-top: 10px;">Manage</a>
</div>
@endif

<!-- Summary Stats -->
<div class="summary-cards">
    <div class="summary-card">
        <h4>Tours This Month</h4>
        <p class="count">{{ $completedThisMonth }}</p>
    </div>
    <div class="summary-card">
        <h4>Total You Earned</h4>
        <p class="count">${{ number_format($earnedThisMonth, 2) }}</p>
    </div>
    <div class="summary-card">
        <h4>Upcoming Tours</h4>
        <p class="count">{{ $upcomingCount }}</p>
    </div>
</div>




@endsection
