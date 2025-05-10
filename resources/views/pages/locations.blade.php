@extends('layouts.app')


@section('title', 'Select a Location')

@section('content')
<link rel="stylesheet" href="{{ asset('css/locations.css') }}">
<div class="location-hero">
    <h1>Choose a Destination</h1>
    <p>Find trusted guides in Sri Lanka's most iconic places.</p>
</div>

<div class="location-grid">
    @foreach ($locations as $location)
        <a href="{{ route('tourist.guides.byLocation', $location) }}" class="location-tile">
            <img src="{{ asset('img/' . strtolower(str_replace(' ', '', $location)) . '.jpg') }}" alt="{{ $location }}">
            <div class="location-name">{{ $location }}</div>
        </a>
    @endforeach
</div>

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
