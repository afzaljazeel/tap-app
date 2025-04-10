@extends('layouts.tourist')

@section('content')
    <div class="dashboard-header">
         <a href="{{ route('home') }}" class="back-btn">← Back to Home</a>
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p>Your personalized dashboard</p>
    </div>

    <section class="dashboard-section">
        <h2>Pending Bookings</h2>
        @include('tourist.partials.booking-list', ['bookings' => $pending])
    </section>

    <section class="dashboard-section">
        <h2>Scheduled Tours</h2>
        @include('tourist.partials.booking-list', ['bookings' => $scheduled])
    </section>

    <section class="dashboard-section">
        <h2>Ongoing Tours</h2>
        @include('tourist.partials.booking-list', ['bookings' => $ongoing])
    </section>

    <section class="dashboard-section">
        <h2>Completed Tours</h2>
        @include('tourist.partials.booking-list', ['bookings' => $completed])
    </section>
@endsection
