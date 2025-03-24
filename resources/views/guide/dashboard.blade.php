<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">
</head>
<body>

    <div class="dashboard-container">
        <div class="dashboard-content">
            <h2>Welcome back, {{ Auth::user()->name }}</h2>

            <!-- Navigation Buttons -->
            <div class="guide-buttons">
                <a href="{{ route('guide.profile') }}">User Profile</a>
                <a href="{{ route('guide.tours') }}">My Tours</a>
                <a href="{{ route('guide.tours.create') }}">Create Tour</a>
                <a href="{{ route('guide.notifications') }}">Notifications</a>
                <a href="{{ route('guide.ongoingTours') }}">Ongoing Tours</a>
                <a href="{{ route('guide.canceledTours') }}">Canceled Tours</a>
                <a href="{{ route('guide.travelHistory') }}">Travel History</a>
                <a href="{{ route('guide.revenue') }}">Monthly Revenue</a>
                <a href="{{ route('guide.support') }}">Contact Support</a>
            </div>

            <!-- Main Info Section -->
            <p>Select an option above to manage your tours or profile.</p>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

</body>
</html>
