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
        <ul class="nav-links" id="navLinks">
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
                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                @endif
            @endauth
        </ul>

        <!-- Right: Profile Icon -->
        @auth
        <div class="user-menu" id="userMenu">
            <button id="user-btn">
                <img src="{{ asset('img/profile_icon.png') }}" alt="Profile" class="profile-icon">
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

        <!-- Hamburger (mobile only) -->
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const navLinks = document.getElementById('navLinks');
        const userMenu = document.getElementById('userMenu');

        navLinks.classList.toggle('show');

        if (userMenu) {
            userMenu.style.display = navLinks.classList.contains('show') ? 'flex' : 'none';
        }
    }
</script>
