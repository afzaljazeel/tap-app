@php
    $showSidebar = false;
@endphp

@extends('layouts.guide')
@section('title', 'My Booking Calendar')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<div class="dashboard-header">
    <h2>📅 My Calendar</h2>
    <p>See all your tour bookings across statuses.</p>
</div>

@foreach ([
    'Scheduled' => $scheduled,
    'Ongoing' => $ongoing,
    'Completed' => $completed,
    'Cancelled' => $cancelled
] as $status => $bookings)
    <div class="card">
        <h3>{{ $status }} Bookings</h3>

        @if($bookings->count())
            <table class="calendar-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Tour Name</th>
                        <th>Tourist</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->preferred_time }}</td>
                            <td>{{ $booking->tour->name ?? 'Tour Deleted' }}</td>
                            <td>{{ $booking->tourist->name ?? 'Tourist Deleted' }}</td>
                            <td>{{ $booking->status }}</td>
                            <td>
                                @if ($booking->status === 'Scheduled' && \Carbon\Carbon::parse($booking->date)->isToday())
                                    <form action="{{ route('guide.booking.start', $booking->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary">Start Tour</button>
                                    </form>
                                @endif

                                @if ($booking->status === 'Ongoing')
                                    <form action="{{ route('guide.booking.complete', $booking->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-success">Mark as Completed</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No {{ strtolower($status) }} bookings.</p>
        @endif
    </div>
@endforeach
@endsection
