<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Admin Greeting -->
        <h2>Welcome, {{ Auth::user()->name }} (Admin)</h2>

        <!-- Navigation Buttons -->
        <div class="admin-buttons">
            <a href="{{ route('admin.profile') }}">User Profile</a>
            <a href="{{ route('admin.users') }}">Manage Users</a>
            <a href="{{ route('admin.notifications') }}">Notifications</a>
            <a href="{{ route('admin.ongoingTours') }}">On Going Tours</a>
            <a href="{{ route('admin.canceledTours') }}">Canceled Tours</a>
            <a href="{{ route('admin.history') }}">Travel History</a>
            <a href="{{ route('admin.revenue') }}">Monthly Revenue</a>
            <a href="{{ route('admin.reviews') }}">Reviews</a>
            <a href="{{ route('admin.support') }}">Contact Support</a>
        </div>

        <!-- Message / Instructions -->
        <p style="text-align: center; margin-top: 30px;">Select a section above to manage content.</p>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" style="text-align: center; margin-top: 20px;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div>

<!-- Toast Message -->
<div id="toast" style="position: fixed; bottom: 30px; right: 30px; padding: 15px 25px; background: #2ecc71; color: white; border-radius: 8px; display: none; z-index: 999;"></div>

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
