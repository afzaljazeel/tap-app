@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<!-- Overview Title -->
<div class="card dashboard-activity">
    <h3>📊 Admin Overview</h3>
    <p>Stay updated with what's happening across the platform.</p>
</div>

<!-- Summary Cards -->
<div class="summary-cards">
    <div class="summary-card">
        <h4>Total Guides</h4>
        <p class="count" id="guideCount">{{ $guideCount ?? '...' }}</p>
    </div>
    <div class="summary-card">
        <h4>Scheduled Tours</h4>
        <p class="count" id="scheduledCount">{{ $scheduled ?? '...' }}</p>
    </div>
    <div class="summary-card">
        <h4>Ongoing Tours</h4>
        <p class="count" id="ongoingCount">{{ $ongoing ?? '...' }}</p>
    </div>
    <div class="summary-card">
        <h4>Completed Tours</h4>
        <p class="count" id="completedCount">{{ $completed ?? '...' }}</p>
    </div>
    <div class="summary-card">
        <h4>Total Revenue</h4>
        <p class="count" id="revenueCount">${{ number_format($totalRevenue ?? 0, 2) }}</p>
    </div>
</div>

<!-- Activity Feed -->
<div class="card activity-card">
    <h3>📢 Recent Booking Activity</h3>

    @if($recentBookings->isEmpty())
        <p>No recent bookings found.</p>
    @else
        <ul class="activity-list">
            @foreach($recentBookings as $booking)
                <li>
                    <span class="activity-icon">📅</span>
                    <span class="activity-text">
                        <strong>{{ $booking->tourist->name ?? 'Deleted Tourist' }}</strong>
                        booked <strong>{{ $booking->tour->name ?? 'Deleted Tour' }}</strong>
                        with <strong>{{ $booking->guide->user->name ?? 'Deleted Guide' }}</strong>
                        on {{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}
                        @if($booking->status)
                            <span class="badge-status {{ strtolower($booking->status) }}">{{ $booking->status }}</span>
                        @endif
                    </span>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<!-- Fetch Counts Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchCounts();
    });

   
</script>

@endsection
