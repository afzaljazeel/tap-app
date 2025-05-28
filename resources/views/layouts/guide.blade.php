@php
    $route = Route::currentRouteName();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Dashboard - @yield('title', 'TAP Guide')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/guide-tours.css') }}">
</head>
<body>
    <div class="dashboard-container" style="display: flex; min-height: 100vh;">

        <!-- Sidebar -->
        @if (!isset($showSidebar) || $showSidebar)
        <aside class="sidebar" style="width: 240px; background-color: #f8f9fa; padding: 20px;">
            <div class="guide-profile" style="text-align: center;">
                <img src="{{ asset(Auth::user()->guide->profile_picture ? 'storage/' . Auth::user()->guide->profile_picture : 'img/profile-placeholder.png') }}" alt="Guide Avatar" style="width: 80px; border-radius: 50%;">
                <h3 style="margin-top: 10px;">{{ Auth::user()->name }}</h3>
            </div>

            <nav style="margin-top: 30px;">
                <ul style="list-style: none; padding: 0;">
                    <li><a href="{{ route('guide.dashboard') }}" class="{{ $route === 'guide.dashboard' ? 'active' : '' }}">Dashboard</a></li>
                    <li><a href="{{ route('guide.tours') }}" class="{{ $route === 'guide.tours' ? 'active' : '' }}">Tours</a></li>
                    <li><a href="{{ route('guide.profile') }}" class="{{ $route === 'guide.profile' ? 'active' : '' }}">User Profile</a></li>
                    <li><a href="{{ route('guide.notifications') }}" class="{{ $route === 'guide.notifications' ? 'active' : '' }}">Notifications</a></li>
                    <li><a href="{{ route('guide.calendar') }}" class="{{ $route === 'guide.calendar' ? 'active' : '' }}">My Calendar</a></li>
                    <li><a href="{{ route('guide.canceledTours') }}" class="{{ $route === 'guide.canceledTours' ? 'active' : '' }}">Canceled Tours</a></li>
                    <li><a href="{{ route('guide.travelHistory') }}" class="{{ $route === 'guide.travelHistory' ? 'active' : '' }}">Travel History</a></li>
                    <li><a href="{{ route('guide.revenue') }}" class="{{ $route === 'guide.revenue' ? 'active' : '' }}">Monthly Revenue</a></li>
                   

                    <li>
                        <a href="{{ route('home') }}" target="_blank" style="background-color: #e0f2fe; color: #0369a1; font-weight: 500;">
                            Visit Site
                        </a>
                    </li>
                </ul>

                <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </nav>
        </aside>
        @endif

        <!-- Main Content -->
        <main class="dashboard-content" style="flex: 1; padding: 30px;">
            @if (isset($showSidebar) && !$showSidebar)
                @include('layouts.navigation')
            @endif

            @yield('content')
        </main>
    </div>

    <style>
        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 8px;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #e2e8f0;
        }

        .sidebar a.active {
            background-color: #10b981;
            color: white;
        }

        .logout-btn {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }
    </style>
</body>
</html>
