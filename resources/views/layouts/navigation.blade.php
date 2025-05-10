<nav class="navbar">
    <div class="nav-container">
        <!-- Left: Logo -->
        <div class="nav-logo">
            <a href="{{ route('home') }}">
                <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
                <img src="{{ asset('img/logo_high_res.png') }}" alt="Logo">
            </a>
        </div>

        <!-- Center: Nav Links -->
        @php
            //Detect if current route is a dashboard page
            $isDashboard = request()->is('guide/*') || request()->is('admin/*');
        @endphp

        <ul class="nav-links" id="navLinks">
            @if(!$isDashboard)
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('guides') }}" class="{{ request()->routeIs('guides') ? 'active' : '' }}">Guides</a></li>
            <li><a href="{{ route('locations') }}" class="{{ request()->routeIs('locations') ? 'active' : '' }}">Locations</a></li>
            @endif

            @auth
                @if ($isDashboard)
                    <li><a href="{{ route('home') }}">Visit Website</a></li>
                @endif

            @endauth
        </ul>

        <!-- Right: Dashboard & Logout -->
        @auth
        <div class="nav-right" id="navRight">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="dashboard-link">Dashboard</a>
            @elseif(Auth::user()->role === 'guide')
                <a href="{{ route('guide.dashboard') }}" class="dashboard-link">Dashboard</a>
            @else
                <a href="{{ route('tourist.dashboard') }}" class="dashboard-link">Dashboard</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
        @endauth


        <!-- Hamburger (mobile only) -->
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const navLinks = document.getElementById('navLinks');
        const navRight = document.getElementById('navRight');

        navLinks.classList.toggle('show');
        if (navRight) navRight.classList.toggle('show');
    }
</script>
