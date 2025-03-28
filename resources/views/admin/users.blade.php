@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('css/admin-manage-users.css') }}">


@section('content')
<div class="container">
    <h2 class="page-title">Manage Users</h2>

    <div class="user-type-buttons">
        <button onclick="loadGuideList()">Guides</button>
        <button onclick="loadTouristList()">Tourists</button>
    </div>

    <div id="user-list">
        <p>Select a category to view users.</p>
    </div>
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

    document.addEventListener("DOMContentLoaded", function () {
        loadGuideList();
    });
</script>
@endsection
