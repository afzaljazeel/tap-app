<h2>Manage Users</h2>

<div class="stats-container" style="display: flex; gap: 20px; margin-bottom: 20px;">
    <div class="stat-box" style="background: #f0f0f0; padding: 20px; border-radius: 10px;">
        <h3>Total Guides</h3>
        <p id="guide-count">...</p>
    </div>
    <div class="stat-box" style="background: #f0f0f0; padding: 20px; border-radius: 10px;">
        <h3>Total Tourists</h3>
        <p id="tourist-count">...</p>
    </div>
</div>

<div>
    <button onclick="loadGuideList()">Guides</button>
    <button onclick="loadTouristList()">Tourists</button>
</div>

<div id="user-list">
    <p>Select a category to view users.</p>
</div>

<script>
    function loadGuideList() {
        document.getElementById('user-list').innerHTML = "<p>Loading Guides...</p>";
        fetch("/admin/users/guides")
            .then(res => res.text())
            .then(data => {
                document.getElementById('user-list').innerHTML = data;
            })
            .catch(() => {
                document.getElementById('user-list').innerHTML = "<p>Failed to load guides.</p>";
            });
    }

    function loadTouristList() {
        document.getElementById('user-list').innerHTML = "<p>Loading Tourists...</p>";
        fetch("/admin/users/tourists")
            .then(res => res.text())
            .then(data => {
                document.getElementById('user-list').innerHTML = data;
            })
            .catch(() => {
                document.getElementById('user-list').innerHTML = "<p>Failed to load tourists.</p>";
            });
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadGuideList(); // triggers on page load
    });
</script>

