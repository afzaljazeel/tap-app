@php
    $showSidebar = true;
@endphp

@extends('layouts.guide')
@section('title', 'Canceled Tours')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-calendar.css') }}">

<div class="dashboard-header">
    <h2>❌ Canceled Tours</h2>
    <p>All tours that have been canceled or declined.</p>
</div>

<div class="booking-block">
    @forelse ($cancelled as $booking)
        <div class="booking-card">
            <div class="booking-info">
                <h4>{{ $booking->tour->name ?? 'Tour Deleted' }}</h4>
                <p><strong>Tourist:</strong> {{ $booking->tourist->name ?? 'Tourist Deleted' }}</p>
                <p><strong>Date:</strong> {{ $booking->date }} | <strong>Time:</strong> {{ $booking->preferred_time }}</p>
                <p class="status canceled">Status: {{ $booking->status }}</p>
                @if($booking->notes)
                    <p><strong>Notes:</strong> {{ $booking->notes }}</p>
                @endif
            </div>
        </div>
    @empty
        <p class="no-booking-msg">No canceled bookings to show.</p>
    @endforelse
</div>
@endsection
