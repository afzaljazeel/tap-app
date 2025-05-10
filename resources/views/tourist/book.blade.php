@extends('layouts.app')

@section('title', 'Book "' . $tour->name . '"')

@section('content')
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">

<div class="section-heading">
    <h1>Book "{{ $tour->name }}"</h1>
    <p>Reserve your spot and enjoy the experience.</p>
</div>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<div class="booking-container">
    <div class="booking-summary card">
        @if ($tour->picture)
            <img src="{{ asset('storage/' . $tour->picture) }}" alt="{{ $tour->name }}" class="tour-image">
        @endif

        <h3>{{ $tour->name }}</h3>
        <p><strong>Guide:</strong> {{ $tour->guide->user->name }}</p>
        <p>{{ $tour->details }}</p>
        <p><strong>Duration:</strong> {{ $tour->duration }} hrs</p>
        <p><strong>Price:</strong> ${{ number_format($tour->amount, 2) }}</p>
    </div>

    <form action="{{ route('tourist.tour.submitBooking', $tour->id) }}" method="POST" class="booking-form card">
        @csrf

        <label for="date">Date:</label>
        <input type="date" name="date" required min="{{ date('Y-m-d') }}">

        <label for="preferred_time">Preferred Time:</label>
        <select name="preferred_time" required>
            <option value="">-- Select Time --</option>
            <option value="Morning">Morning</option>
            <option value="Evening">Evening</option>
            <option value="Night">Night</option>
        </select>

    <script>
        const bookedSlots = @json($bookedSlots);

        const slotTimes = {
            'Morning': 8,
            'Evening': 14,
            'Night': 19
        };

        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.querySelector('input[name="date"]');
            const timeSelect = document.querySelector('select[name="preferred_time"]');

            dateInput.addEventListener('change', function () {
                const selectedDate = this.value;
                const today = new Date().toISOString().split('T')[0];
                const currentHour = new Date().getHours();
                const isToday = selectedDate === today;
                const booked = bookedSlots[selectedDate] || [];

                // Reset all options
                Array.from(timeSelect.options).forEach(option => {
                    if (option.value !== "") {
                        option.disabled = false;
                        option.style.display = 'block';
                    }
                });

                // Disable if already booked
                booked.forEach(slot => {
                    const option = timeSelect.querySelector(`option[value="${slot}"]`);
                    if (option) {
                        option.disabled = true;
                        option.style.display = 'none';
                    }
                });

                // Disable past time slots if selected date is today
                if (isToday) {
                    for (const [slot, hour] of Object.entries(slotTimes)) {
                        if (currentHour >= hour) {
                            const option = timeSelect.querySelector(`option[value="${slot}"]`);
                            if (option) {
                                option.disabled = true;
                                option.style.display = 'none';
                            }
                        }
                    }
                }
            });
        });
    </script>

        <label for="notes">Notes (optional):</label>
        <textarea name="notes" rows="3" placeholder="Any message for the guide..."></textarea>

        <button type="submit" class="btn-primary">Send Booking Request</button>
    </form>
</div>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-content">
        <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="footer-logo">
        <p class="footer-slogan">Your Dream Tour, One Tap Away.</p>
        <p class="footer-contact">Contact: info@tapaguide.com</p>
        <p class="footer-rights">© 2025 Tap A Guide | All Rights Reserved</p>
    </div>
</footer>

@endsection
