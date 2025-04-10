@extends('layouts.app')

@section('title', 'Book "' . $tour->name . '"')

@section('content')
<link rel="stylesheet" href="{{ asset('css/locations.css') }}">

<div class="section-heading">
    <h1>Book "{{ $tour->name }}"</h1>
    <p>Reserve your spot and enjoy the experience.</p>
</div>

<div class="booking-container">
    <div class="booking-summary card">
        @if ($tour->picture)
            <img src="{{ asset('storage/' . $tour->picture) }}" alt="{{ $tour->name }}" class="tour-image">
        @endif
        <h3>{{ $tour->name }}</h3>
        <p>{{ $tour->details }}</p>
        <p><strong>Duration:</strong> {{ $tour->duration }} hrs</p>
        <p><strong>Price:</strong> ${{ number_format($tour->amount, 2) }}</p>
    </div>

    <form action="{{ route('tourist.tour.submitBooking', $tour->id) }}" method="POST" class="booking-form card">
        @csrf

        <label for="date">Date:</label>
        <input type="date" name="date" required min="{{ date('Y-m-d') }}">

        <label for="preferred_time">Preferred Time:</label>
        <select name="preferred_time" required>
            <option value="">-- Select Time --</option>
            <option value="Morning">Morning</option>
            <option value="Evening">Evening</option>
            <option value="Night">Night</option>
        </select>

        <label for="notes">Notes (optional):</label>
        <textarea name="notes" rows="3" placeholder="Any message for the guide..."></textarea>

        <button type="submit" class="btn-primary">Send Booking Request</button>
    </form>
</div>
@endsection
