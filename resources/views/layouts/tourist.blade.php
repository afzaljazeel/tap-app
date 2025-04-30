<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/tourist-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tourist-book.css') }}">
    

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
                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a href="{{ route('tourist.dashboard') }}">My Bookings</a></li>
                    {{-- Add more links later like notifications, reviews, etc --}}
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
