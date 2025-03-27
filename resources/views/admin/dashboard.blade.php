<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Fonts & CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-kit.js" crossorigin="anonymous"></script>

    <style>
       
    </style>
</head>
<body>

  
    <div class="admin-hero">
        <img src="{{ asset('img/hero.jpg') }}" alt="Hero Background" class="hero-img">

        <div class="hero-overlay">
        <div class="hero-title">
    <span class="hero-text">one</span>
    <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="hero-logo-img">
    <span class="hero-text">away</span>
</div>

            <div class="search-bar">
                <input type="text" placeholder="Search Guides">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <!-- Sidebar + Content Wrapper -->
    <div class="admin-wrapper">

        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="admin-avatar">
                <img src="{{ asset('img/admin_avatar.jpg') }}" alt="Admin Avatar">
                <span class="badge">Bronze level</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.profile') }}">User Profile</a>
                <a href="{{ route('admin.users') }}">Manage Users</a>
                <a href="{{ route('admin.notifications') }}">Notifications</a>
                <a class="active" href="{{ route('admin.ongoingTours') }}">On going Tours</a>
                <a href="{{ route('admin.canceledTours') }}">Canceled Tours</a>
                <a href="{{ route('admin.history') }}">Travel History</a>
                <a href="{{ route('admin.revenue') }}">Monthly Revenue</a>
                <a href="{{ route('admin.reviews') }}">Reviews</a>
                <a href="{{ route('admin.support') }}">Contact Support</a>
            </nav>
        </aside>

        <main class="dashboard">
    <div class="dashboard-header">
        <h2>Welcome back, <span>Admin</span></h2>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</main>


    <!-- Toast Message -->
    <div id="toast" class="toast"></div>

    <script>
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            toast.innerText = message;
            toast.style.background = type === 'error' ? '#e74c3c' : '#2ecc71';
            toast.style.display = 'block';
            setTimeout(() => toast.style.display = 'none', 3000);
        }
    </script>
</body>
</html>
