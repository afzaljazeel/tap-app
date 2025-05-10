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
                <span class="hero-text">Admin</span>
                <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="hero-logo-img">
                <span class="hero-text">Dashboard</span>
            </div>
        </div>
    </div>

    <!-- Sidebar + Content Wrapper -->
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-avatar">
                <img src="{{ asset('img/admin_avatar.jpg') }}" alt="Admin Avatar">
            </div>

            @php $route = Route::currentRouteName(); @endphp

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ $route === 'admin.dashboard' ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.profile') }}" class="{{ $route === 'admin.profile' ? 'active' : '' }}">User Profile</a>
                <a href="{{ route('admin.users') }}" class="{{ $route === 'admin.users' ? 'active' : '' }}">Manage Users</a>
                <a href="{{ route('admin.scheduledTours') }}" class="{{ $route === 'admin.scheduledTours' ? 'active' : '' }}">Scheduled Tours</a>
                <a href="{{ route('admin.ongoingTours') }}" class="{{ $route === 'admin.ongoingTours' ? 'active' : '' }}">On going Tours</a>
                <a href="{{ route('admin.canceledTours') }}" class="{{ $route === 'admin.canceledTours' ? 'active' : '' }}">Canceled Tours</a>
                <a href="{{ route('admin.completedTours') }}" class="{{ $route === 'admin.completedTours' ? 'active' : '' }}">Completed Tours</a>
                <a href="{{ route('admin.revenue') }}" class="{{ $route === 'admin.revenue' ? 'active' : '' }}">Revenue</a>
                 <a href="{{ route('home') }}" target="_blank" class="sidebar-btn" style="background-color: #e0f2fe; color: #0369a1; font-weight: 600; display: block; text-align: center; padding: 10px 0; border-radius: 6px; margin-top: 20px;">
                    View Site
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top: 12px;">
                    @csrf
                    <button type="submit" class="logout-btn" style="width: 100%;">Logout</button>
                </form>
            </nav>

            <!-- Bottom Buttons -->

        </aside>

        <!-- Main Content -->
        <main class="dashboard">
            <div class="dashboard-header">
                <h2>Welcome back, <span>Admin</span></h2>
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
