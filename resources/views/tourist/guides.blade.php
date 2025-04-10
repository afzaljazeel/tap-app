@extends('layouts.app')

@section('title', 'Guides in ' . $location)

@section('content')
<link rel="stylesheet" href="{{ asset('css/locations.css') }}">

<div class="section-heading">
    <h1>Guides in {{ $location }}</h1>
    <p>Choose from our verified travel guides</p>
</div>

<div class="card-grid">
    @forelse ($guides as $guide)
        <div class="card">
        <img src="{{ asset('storage/' . $guide->profile_picture) }}" alt="{{ $guide->user->name }}" class="tour-image">

            <h3>{{ $guide->user->name }}</h3>
            <p><strong>Experience:</strong> {{ $guide->experience ?? 'To be updated' }}</p>
            <p><strong>Specialties:</strong>
                @if ($guide->specialties)
                    @foreach (explode(',', $guide->specialties) as $spec)
                        <span class="specialty-bubble">{{ trim($spec) }}</span>
                    @endforeach
                @else
                    To be updated
                @endif
            </p>
            <a href="{{ route('tourist.guide.tours', $guide->id) }}" class="btn-primary">View Tours</a>
        </div>
    @empty
        <p>No guides available in {{ $location }} right now.</p>
    @endforelse
</div>
@endsection
