@extends('layouts.app')

@section('title', $guide->user->name . ' - Guide Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-profile.css') }}">

<div class="guide-profile-container">
    <h1 class="guide-name">{{ $guide->user->name }}</h1>
    <img src="{{ asset('storage/' . $guide->profile_picture) }}" alt="{{ $guide->user->name }}" class="guide-image">

    <p class="guide-details"><strong>Location:</strong> {{ $guide->location }}</p>
    <p class="guide-details"><strong>Certification:</strong> {{ $guide->certification ?? 'To be updated' }}</p>
    <p class="guide-details"><strong>Experience:</strong> {{ $guide->experience ?? 'To be updated' }}</p>
    <p class="guide-details"><strong>Specialties:</strong> 
        @if ($guide->specialties)
            @foreach (explode(',', $guide->specialties) as $specialty)
                <span class="specialty-tag">{{ trim($specialty) }}</span>
            @endforeach
        @else
            To be updated
        @endif
    </p>
</div>


<!-- Tours Section with green background -->
<section class="listed-tours-section">
<!-- Divider Line -->
<hr class="section-divider">

<!-- Section Title -->
<h2 class="listed-tours-heading">Listed Tours</h2>

    <div class="tour-cards">
        @forelse ($tours as $tour)
            <div class="tour-card">
                @if ($tour->picture)
                    <img src="{{ asset('storage/' . $tour->picture) }}" alt="{{ $tour->name }}">
                @endif
                <h3>{{ $tour->name }}</h3>
                <p>{{ $tour->details }}</p>
                <p><strong>Duration:</strong> {{ $tour->duration }}</p>
                <p><strong>Price:</strong> ${{ number_format($tour->amount, 2) }}</p>
                
                @auth
                    @if(Auth::user()->role === 'tourist')
                        <a href="{{ route('tourist.tour.bookForm', $tour->id) }}" class="btn-primary">Book Now</a>
                    @else
                        <button class="btn-disabled" disabled>Book Now</button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Login to Book</a>
                @endauth
            </div>
        @empty
            <p class="no-tours">No tours found for this guide.</p>
        @endforelse
    </div>
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
