@php
    $showSidebar = true;
@endphp

@extends('layouts.guide')
@section('title', 'My Booking Calendar')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-calender.css') }}">

<div class="dashboard-header">
    <h2>📅 My Calendar</h2>
    <p>See all your tour bookings across statuses.</p>
</div>

<!-- Scheduled Bookings -->
<div class="booking-block">
    <h3>📆 Scheduled Bookings</h3>

    @forelse ($scheduled as $booking)
        <div class="booking-card">
            <div class="booking-info">
                <h4>{{ $booking->tour->name ?? 'Tour Deleted' }}</h4>
                <p><strong>Tourist:</strong> {{ $booking->tourist->name ?? 'Tourist Deleted' }}</p>
                <p><strong>Date:</strong> {{ $booking->date }} | <strong>Time:</strong> {{ $booking->preferred_time }}</p>
                <p class="status scheduled">Status: {{ $booking->status }}</p>
            </div>
            <div class="booking-actions">
                @if ($booking->status === 'Scheduled' && \Carbon\Carbon::parse($booking->date)->isToday())
                    <form action="{{ route('guide.booking.start', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary">Start Tour</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="no-booking-msg">No scheduled bookings.</p>
    @endforelse
</div>

<!-- Ongoing Bookings -->
<div class="booking-block">
    <h3>🚗 Ongoing Bookings</h3>

    @forelse ($ongoing as $booking)
        <div class="booking-card">
            <div class="booking-info">
                <h4>{{ $booking->tour->name ?? 'Tour Deleted' }}</h4>
                <p><strong>Tourist:</strong> {{ $booking->tourist->name ?? 'Tourist Deleted' }}</p>
                <p><strong>Date:</strong> {{ $booking->date }} | <strong>Time:</strong> {{ $booking->preferred_time }}</p>
                <p class="status ongoing">Status: {{ $booking->status }}</p>
            </div>
            <div class="booking-actions">
                <form action="{{ route('guide.booking.complete', $booking->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-success">Mark as Completed</button>
                </form>
            </div>
        </div>
    @empty
        <p class="no-booking-msg">No ongoing bookings.</p>
    @endforelse
</div>
@endsection
