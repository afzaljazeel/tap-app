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
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="guide-profile">
                <img src="{{ asset('img/profile-placeholder.png') }}" alt="Guide Avatar">
                <h3>{{ Auth::user()->name }}</h3>
                <p>Guide Level: Gold</p>
            </div>

            <nav>
                <ul>
                    <li><a href="{{ route('guide.profile') }}">User Profile</a></li>
                    <li><a href="{{ route('guide.notifications') }}">Notifications</a></li>
                    <li><a href="{{ route('guide.ongoingTours') }}">Ongoing Tours</a></li>
                    <li><a href="{{ route('guide.canceledTours') }}">Canceled Tours</a></li>
                    <li><a href="{{ route('guide.travelHistory') }}">Travel History</a></li>
                    <li><a href="{{ route('guide.revenue') }}">Monthly Revenue</a></li>
                    <li><a href="{{ route('guide.support') }}">Contact Support</a></li>
                </ul>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-content">
            @yield('content')
        </main>
    </div>

</body>
</html>
