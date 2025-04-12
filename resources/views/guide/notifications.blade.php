@php
    $showSidebar = false;
@endphp

@extends('layouts.guide')

@section('title', 'Booking Notifications')

@section('content')

<div class="dashboard-section">
    <h2>Booking Requests</h2>

    @if($bookings->isEmpty())
        <p>No booking requests at the moment.</p>
    @else
        <div class="card-grid">
            @foreach ($bookings as $booking)
                <div class="card">
                    <h3>{{ $booking->tourist->name }}</h3>
                    <p><strong>Tour:</strong> {{ $booking->tour->name }}</p>
                    <p><strong>Date:</strong> {{ $booking->date }}</p>
                    <p><strong>Time:</strong> {{ $booking->preferred_time }}</p>
                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'N/A' }}</p>

                    <form action="{{ route('guide.booking.approve', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-primary">Approve</button>
                    </form>

                    <!-- Decline with Reason (Modal-like inline) -->
                    <form action="{{ route('guide.booking.decline', $booking->id) }}" method="POST" style="display:inline; margin-left: 10px;">
                        @csrf
                        <input type="text" name="reason" placeholder="Reason for decline" required style="padding: 4px; width: 160px;">
                        <button type="submit" class="btn-danger">Decline</button>
                    </form>

                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection