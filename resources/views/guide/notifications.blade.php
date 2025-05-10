@php
    $showSidebar = true;
    $route = Route::currentRouteName();
@endphp

@extends('layouts.guide')

@section('title', 'Booking Notifications')

@section('content')

@if (session('success'))
    <div class="toast toast-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="toast toast-error">
        {{ session('error') }}
    </div>
@endif

<link href="{{ asset('css/guide-notification.css') }}" rel="stylesheet">

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

                    <div class="actions">
                        <form action="{{ route('guide.booking.approve', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary">Approve</button>
                        </form>

                        <form action="{{ route('guide.booking.decline', $booking->id) }}" method="POST">
                            @csrf
                            <input type="text" name="reason" placeholder="Reason for decline" required>
                            <button type="submit" class="btn-danger">Decline</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
