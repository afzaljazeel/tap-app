<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/guide-dashboard.js') }}"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="guide-profile">
                <img src="{{ asset('img/profile-placeholder.png') }}" alt="Guide Profile">
                <h3>{{ Auth::user()->name }}</h3>
                <p>Guide Level: Gold</p>
            </div>
            <nav>
                <ul>
                    <li class="active">User Profile</li>
                    <li>Notifications</li>
                    <li id="ongoing-tours">Ongoing Tours</li>
                    <li id="canceled-tours">Canceled Tours</li>
                    <li id="travel-history">Travel History</li>
                    <li id="monthly-revenue">Monthly Revenue</li>
                    <li>Contact Support</li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-content" id="content-area">
            <h2>Welcome back, {{ Auth::user()->name }}</h2>
            
            <section class="tour-details">
                <h3>Your Tour Details</h3>
                <div class="tour-card">
                    <div class="tour-info">
                        <h4>Temple of the Sacred Tooth Relic Tour</h4>
                        <p>Entrance Ticket + Guided Tour</p>
                        <p><strong>Date:</strong> Thursday, January 16, 2025</p>
                        <p><strong>Duration:</strong> 2hr - 3hr</p>
                        <p><strong>Travelers:</strong> 2 Adults</p>
                        <p><strong>Meeting Point:</strong> Starts Around 9:00 AM</p>
                    </div>
                    <div class="tour-contact">
                        <h4>Contact Details</h4>
                        <p><strong>First Name:</strong> Dilshan</p>
                        <p><strong>Email:</strong> x@dilshan.me</p>
                        <p><strong>Phone Number:</strong> 012 345 67 89</p>
                        <p><strong>Payment Method:</strong> Cash</p>
                        <p><strong>Total Amount:</strong> $50.00</p>
                        <button class="cancel">Cancel Booking</button>
                        <button class="contact">Contact Your Tourist</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            $(".sidebar nav ul li").click(function () {
                $(".sidebar nav ul li").removeClass("active");
                $(this).addClass("active");
                
                let section = $(this).attr("id");
                $("#content-area").html('<h3>Loading ' + section.replace('-', ' ') + '...</h3>');
                
                setTimeout(function () {
                    $("#content-area").html('<h3>' + section.replace('-', ' ') + '</h3><p>Dynamic content for ' + section.replace('-', ' ') + ' will load here.</p>');
                }, 1000);
            });
        });
    </script>
</body>
</html>
