<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/tourist-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tourist-book.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tourist-modern.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile-section">
                <img src="{{ asset('img/tourist.png') }}" alt="Tourist Avatar">
                <h3>{{ Auth::user()->name }}</h3>
                <p>Tourist Dashboard</p>
            </div>

            <nav class="nav-links">
                <ul>
                    <li>
                        <a href="{{ route('tourist.dashboard') }}" class="{{ request()->routeIs('tourist.dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tourist.mybookings') }}" class="{{ request()->routeIs('tourist.mybookings') ? 'active' : '' }}">
                            My Bookings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tourist.completed') }}" class="{{ request()->routeIs('tourist.completed') ? 'active' : '' }}">
                            Tour History
                        </a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </nav>
        </aside>

        <main class="dashboard-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
