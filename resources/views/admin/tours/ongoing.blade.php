@php
    $showSidebar = true;
    $route = Route::currentRouteName();
@endphp

@extends('layouts.admin')

@section('title', 'Ongoing Tours')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<!-- Header -->
<div class="dashboard-header">
    <h2>🚶 Ongoing Tours</h2>
    <p>Tours currently in progress across the platform.</p>
</div>



<!-- Ongoing Tours Table -->
@if($bookings->count())
    <div class="card tour-table-card">
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Tour</th>
                    <th>Guide</th>
                    <th>Tourist</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</td>
                        <td>
                            <span class="badge-time {{ strtolower($booking->preferred_time) }}">
                                {{ $booking->preferred_time }}
                            </span>
                        </td>
                        <td>{{ $booking->tour->name ?? 'Tour Deleted' }}</td>
                        <td>{{ $booking->guide->user->name ?? 'Guide Deleted' }}</td>
                        <td>{{ $booking->tourist->name ?? 'Tourist Deleted' }}</td>
                        <td>${{ number_format($booking->tour->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="card">
        <p>No ongoing tours currently.</p>
    </div>
@endif
@endsection
