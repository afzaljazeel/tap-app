<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Dashboard</title>

    <!-- Fonts & CSS -->
    <link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Hero Section -->
    <div class="admin-hero">
        <img src="{{ asset('img/hero.jpg') }}" alt="Hero Background" class="hero-img">

        <div class="hero-overlay">
            <div class="hero-title">
                <span class="hero-text">guide</span>
                <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="hero-logo-img">
                <span class="hero-text">panel</span>
            </div>
        </div>
    </div>

    <!-- Sidebar + Content Wrapper -->
    <div class="admin-wrapper">

        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="admin-avatar">
                <img src="{{ asset('img/guide.jpg') }}" alt="Guide Avatar">
                <span class="badge">Verified Guide</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('guide.profile') }}">User Profile</a>
                <a href="{{ route('guide.tours') }}">My Tours</a>
                <a href="{{ route('guide.tours.create') }}">Create Tour</a>
                <a href="{{ route('guide.notifications') }}">Notifications</a>
                <a href="{{ route('guide.ongoingTours') }}">Ongoing Tours</a>
                <a href="{{ route('guide.canceledTours') }}">Canceled Tours</a>
                <a href="{{ route('guide.travelHistory') }}">Travel History</a>
                <a href="{{ route('guide.revenue') }}">Monthly Revenue</a>
                <a href="{{ route('guide.support') }}">Contact Support</a>
            </nav>
        </aside>

        <!-- Dashboard Main Content -->
        <main class="dashboard">
            <div class="dashboard-header">
                <h2>Welcome back, <span>{{ Auth::user()->name }}</span></h2>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>

            <p>Select an option from the left to manage your tours or profile.</p>
        </main>
    </div>

</body>
</html>
