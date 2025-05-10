@php
    $route = Route::currentRouteName();
@endphp

@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-manage-users.css') }}">

<div class="container">
    <h2 class="page-title">Manage Users</h2>

    <div class="user-type-buttons">
        <button onclick="loadGuideList()" id="btn-guides">Guides</button>
        <button onclick="loadTouristList()" id="btn-tourists">Tourists</button>
    </div>

    <div id="user-list" class="user-content-card">
        <p>Select a category to view users.</p>
    </div>
</div>

<script>
    function loadGuideList() {
        toggleActiveButton('btn-guides');
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
        toggleActiveButton('btn-tourists');
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

    function toggleActiveButton(id) {
        document.getElementById('btn-guides').classList.remove('active-tab');
        document.getElementById('btn-tourists').classList.remove('active-tab');
        document.getElementById(id).classList.add('active-tab');
    }

    document.addEventListener("DOMContentLoaded", function () {
        loadGuideList(); // Default load
    });
</script>
@endsection
