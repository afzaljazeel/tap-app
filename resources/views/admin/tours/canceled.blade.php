@php
    $showSidebar = true;
    $route = Route::currentRouteName();
@endphp

@extends('layouts.admin')

@section('title', 'Canceled Tours')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<!-- Header -->
<div class="dashboard-header">
    <h2>❌ Canceled Tours</h2>
    <p>All tours that were declined or canceled by guides or tourists.</p>
</div>

<!-- Table Section -->
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
                    <th>Notes</th>
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
                        <td>{{ $booking->notes ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="card">
        <p>No canceled tours found.</p>
    </div>
@endif
@endsection
