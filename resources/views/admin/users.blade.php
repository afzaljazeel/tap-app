<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage users Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>


<h2 class="manage-users-header">Manage Users</h2>

<div class="user-type-buttons">
    <button onclick="loadGuideList()">Guides</button>
    <button onclick="loadTouristList()">Tourists</button>
</div>

<div id="user-list">
    <p>Select a category to view users.</p>
</div>

</body>


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

    document.addEventListener("DOMContentLoaded", function () {
        loadGuideList(); // triggers on page load
    });
</script>
