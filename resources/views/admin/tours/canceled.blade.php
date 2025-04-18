@php $showSidebar = true; @endphp

@extends('layouts.app')

@section('title', 'Canceled Tours')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<div class="dashboard-header">
    <h2>Canceled Tours</h2>
    <p>All tours declined or canceled by guides or tourists.</p>
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
                    <th>Notes</th>
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
                        <td>{{ $booking->notes ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No canceled tours.</p>
@endif
@endsection
