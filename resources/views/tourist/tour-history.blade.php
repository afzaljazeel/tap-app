@extends('layouts.tourist')

@section('title', 'Tour History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tourist-moderndash.css') }}">

<div class="dashboard-header">
    <a href="{{ route('tourist.dashboard') }}" class="back-btn">← Back to Dashboard</a>
    <h1>Tour History</h1>
</div>

<hr class="full-divider">

<section class="dashboard-section">
    <h2>Completed Tours</h2>

    @if ($completed->isEmpty())
        <p>No completed tours yet.</p>
    @else
        <ul class="booking-list align-left">
            @foreach ($completed as $booking)
                <li class="card booking-card">
                    <div class="card-row">
                        <div>
                            <strong>{{ $booking->tour->name }}</strong>
                        </div>
                        <div>
                            Date: {{ $booking->date }}<br>
                            Time: {{ $booking->preferred_time }}
                        </div>
                    </div>
                    <span class="status completed">Completed</span>
                </li>
            @endforeach
        </ul>
    @endif
</section>

<hr class="full-divider">

<section class="dashboard-section">
    <h2>Cancelled Tours</h2>

    @if ($cancelled->isEmpty())
        <p>No cancelled tours yet.</p>
    @else
        <ul class="booking-list align-left">
            @foreach ($cancelled as $booking)
                <li class="card booking-card">
                    <div class="card-row">
                        <div>
                            <strong>{{ $booking->tour->name }}</strong>
                        </div>
                        <div>
                            Date: {{ $booking->date }}<br>
                            Time: {{ $booking->preferred_time }}
                        </div>
                    </div>
                    <span class="status cancelled">Cancelled</span>
                </li>
            @endforeach
        </ul>
    @endif
</section>
@endsection
