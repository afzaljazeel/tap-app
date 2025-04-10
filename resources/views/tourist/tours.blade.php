@extends('layouts.app')

@section('title', 'Tours by ' . $guide->user->name)

@section('content')
<link rel="stylesheet" href="{{ asset('css/locations.css') }}">

<div class="section-heading">
    <h1>Tours by {{ $guide->user->name }}</h1>
    <p>Explore the available tour packages and book your experience.</p>
</div>

<div class="card-grid">
    @forelse ($tours as $tour)
        <div class="card">
        @if ($tour->picture)
        <img src="{{ asset('storage/' . $tour->picture) }}" alt="{{ $tour->name }}" class="tour-image">

        @endif
            <h3>{{ $tour->name }}</h3>
            <p>{{ $tour->details }}</p>
            <p><strong>Duration:</strong> {{ $tour->duration }} hrs</p>
            <p><strong>Price:</strong> ${{ number_format($tour->amount, 2) }}</p>
            <a href="{{ route('tourist.tour.bookForm', $tour->id) }}" class="btn-primary">Book Now</a>
        </div>
    @empty
        <p>No tours found for this guide.</p>
    @endforelse
</div>
@endsection
