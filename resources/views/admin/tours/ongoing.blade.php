@php $showSidebar = true; @endphp

@extends('layouts.app')

@section('title', 'Ongoing Tours')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<div class="dashboard-header">
    <h2>Ongoing Tours</h2>
    <p>All tours currently in progress.</p>
</div>

@if($bookings->count())
    <div class="card">
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
                        <td>{{ $booking->date }}</td>
                        <td>{{ $booking->preferred_time }}</td>
                        <td>{{ $booking->tour->name }}</td>
                        <td>{{ $booking->guide->user->name }}</td>
                        <td>{{ $booking->tourist->name }}</td>
                        <td>${{ number_format($booking->tour->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No ongoing tours currently.</p>
@endif
@endsection
