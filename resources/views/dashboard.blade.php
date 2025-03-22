@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example Dashboard Cards -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800">Total Users</h2>
                <p class="text-2xl font-bold text-blue-600">1,200</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800">Bookings</h2>
                <p class="text-2xl font-bold text-green-600">340</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800">Revenue</h2>
                <p class="text-2xl font-bold text-purple-600">$12,000</p>
            </div>
        </div>

        <!-- User Greeting -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-md mt-8 text-center">
            <h2 class="text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-600">You're logged in. Explore your dashboard and manage your activities.</p>
        </div>
    </div>
@endsection
