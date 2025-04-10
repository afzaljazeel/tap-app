@if ($bookings->isEmpty())
    <p>No bookings in this section.</p>
@else
    <ul class="booking-list">
        @foreach ($bookings as $booking)
            <li class="booking-card">
                <strong>Tour:</strong> {{ $booking->tour->name }}<br>
                <strong>Date:</strong> {{ $booking->date }}<br>
                <strong>Time:</strong> {{ $booking->preferred_time }}<br>
                <strong>Status:</strong> {{ $booking->status }}
            </li>
        @endforeach
    </ul>
@endif
