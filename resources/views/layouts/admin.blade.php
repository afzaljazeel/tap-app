<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Fonts & Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Hero Section -->
    <div class="admin-hero">
        <img src="{{ asset('img/hero.jpg') }}" alt="Hero Background" class="hero-img">

        <div class="hero-overlay">
            <div class="hero-title">
                <span class="hero-text">one</span>
                <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="hero-logo-img">
                <span class="hero-text">away</span>
            </div>
        </div>
    </div>

    <!-- Sidebar + Content Wrapper -->
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-avatar">
                <img src="{{ asset('img/admin_avatar.jpg') }}" alt="Admin Avatar">
                <span class="badge">Bronze level</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.profile') }}">User Profile</a>
                <a href="{{ route('admin.users') }}">Manage Users</a>
                <a href="{{ route('admin.scheduledTours') }}">Scheduled Tours</a>
                <a href="{{ route('admin.ongoingTours') }}">Ongoing Tours</a>
                <a href="{{ route('admin.canceledTours') }}">Canceled Tours</a>
                <a href="{{ route('admin.completedTours') }}">Completed Tours</a>
                <a href="{{ route('admin.revenue') }}">Revenue</a>
                <a href="{{ route('admin.reviews') }}">Reviews</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard">
            <div class="dashboard-header">
                <h2>Welcome back, <span>Admin</span></h2>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
