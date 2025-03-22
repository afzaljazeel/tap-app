<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-profile">
                <img src="{{ asset('img/admin-avatar.png') }}" alt="Admin Avatar">
                <h3>{{ Auth::user()->name }}</h3>
                <p>Admin Level</p>
            </div>
            <nav>
                <ul>
                    <li class="dashboard-link" data-section="profile">User Profile</li>
                    <li class="dashboard-link" data-section="users">Manage Users</li>
                    <li class="dashboard-link" data-section="notifications">Notifications</li>
                    <li class="dashboard-link" data-section="ongoing-tours">On Going Tours</li>
                    <li class="dashboard-link" data-section="canceled-tours">Canceled Tours</li>
                    <li class="dashboard-link" data-section="history">Travel History</li>
                    <li class="dashboard-link" data-section="revenue">Monthly Revenue</li>
                    <li class="dashboard-link" data-section="reviews">Reviews</li>
                    <li class="dashboard-link" data-section="support">Contact Support</li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-content">
            <h2>Welcome back, {{ Auth::user()->name }}</h2>
            <div id="dashboard-section">
                <p>Select an option from the sidebar.</p>
            </div>
        </main>
    </div>

       <script>
    $(document).ready(function () {
        $(".dashboard-link").click(function () {
            $(".dashboard-link").removeClass("active");
            $(this).addClass("active");

            let section = $(this).data("section");

            // Show loading text
            $("#dashboard-section").html('<h3>Loading ' + section.replace('-', ' ') + '...</h3>');

            setTimeout(function () {
                if (section === "users") {
                    $("#dashboard-section").html(`
                        <h2>Manage Users</h2>
                        <div class="user-tabs">
                            <button class="user-tab active" data-user="guides">Guides</button>
                            <button class="user-tab" data-user="tourists">Tourists</button>
                        </div>
                        <div id="user-content">
                            <!-- Default: Load Guides Section -->
                            <h3>Guides</h3>
                            <button onclick="showAddGuideForm()">+ Add Guide</button>
                            <div id="add-guide-form" style="display: none;">
                                <form method="POST" action="{{ route('admin.addGuide') }}">
                                    @csrf
                                    <input type="text" name="name" placeholder="Guide Name" required>
                                    <input type="email" name="email" placeholder="Guide Email" required>
                                    <input type="password" name="password" placeholder="Password" required>
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                    <input type="text" name="experience" placeholder="Years of Experience">
                                    <input type="text" name="certification" placeholder="Certification">
                                    <button type="submit">Add Guide</button>
                                </form>
                            </div>
                            <div id="guides-list">
                                <h3>Loading Guides...</h3>
                            </div>
                        </div>
                    `);

                    loadGuides(); // Load guide list by default
                }
            }, 500);
        });

        // Switch between Guides & Tourists
        $(document).on("click", ".user-tab", function () {
            $(".user-tab").removeClass("active");
            $(this).addClass("active");

            let userType = $(this).data("user");
            $("#user-content").html(`<h3>Loading ${userType}...</h3>`);

            setTimeout(function () {
                if (userType === "guides") {
                    loadGuides();
                } else {
                    loadTourists();
                }
            }, 500);
        });

        // Load Guides List
        function loadGuides() {
            $.get("{{ route('admin.guides') }}", function (data) {
                $("#user-content").html(data);
            });
        }

        // Load Tourists List
        function loadTourists() {
            $.get("{{ route('admin.tourists') }}", function (data) {
                $("#user-content").html(data);
            });
        }

        // Show Add Guide Form
        window.showAddGuideForm = function () {
            $("#add-guide-form").toggle();
        };
    });
    </script>

    <!-- Toast Notification Container -->
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
