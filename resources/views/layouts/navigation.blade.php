<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>

    <!-- Link to Normal CSS -->
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="container">
        
        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            </a>
        </div>

        <!-- Mobile Menu Icon -->
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('guides') }}">Guides</a></li>
            <li><a href="{{ route('locations') }}">Locations</a></li>

            @auth
                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                @elseif(Auth::user()->role === 'guide')
                    <li><a href="{{ route('guide.dashboard') }}">Guide Dashboard</a></li>
                @else
                    <li><a href="{{ route('home') }}">Dashboard</a></li> <!-- Tourists go to Home -->
                @endif
            @endauth
        </ul>

        <!-- User Profile Dropdown -->
        @auth
        <div class="user-menu">
            <button id="user-btn">
                <img src="{{ asset('img/profile-icon.png') }}" alt="Profile" class="profile-icon">
            </button>
            <div class="dropdown">
                <a href="{{ route('profile.edit') }}">Profile</a>
                
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                @elseif(Auth::user()->role === 'guide')
                    <a href="{{ route('guide.dashboard') }}">Guide Dashboard</a>
                @else
                    <a href="{{ route('home') }}">Dashboard</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Log Out</button>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>

<!-- JavaScript for Dropdown & Mobile Menu -->
<script>
    document.getElementById("user-btn").addEventListener("click", function() {
        document.querySelector(".dropdown").classList.toggle("show");
    });

    function toggleMenu() {
        document.querySelector(".nav-links").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('#user-btn')) {
            document.querySelector(".dropdown").classList.remove("show");
        }
    };
</script>

</body>
</html>
