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
@endsection
