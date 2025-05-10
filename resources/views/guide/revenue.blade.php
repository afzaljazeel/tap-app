@php
    $showSidebar = true;
    use Illuminate\Support\Carbon;
@endphp

@extends('layouts.guide')

@section('title', 'My Revenue')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<div class="dashboard-header">
    <h2>📊 My Revenue</h2>
    <p>Track your earnings and commissions by month.</p>
</div>

<!-- Month Filter -->
<form method="GET" class="filter-form" style="margin-bottom: 20px;">
    <label for="month">Select Month:</label>
    <select name="month" id="month" onchange="this.form.submit()" class="month-select">
        @foreach ($months as $month)
            <option value="{{ $month }}" {{ $selectedMonth === $month ? 'selected' : '' }}>
                {{ \Carbon\Carbon::parse($month)->format('F Y') }}
            </option>
        @endforeach
    </select>
</form>

<!-- Summary -->
<div class="revenue-summary">
    <div class="summary-card">
        <h3>Total Income</h3>
        <p>${{ number_format($totalIncome, 2) }}</p>
    </div>
    <div class="summary-card">
        <h3>Total Commission (12%)</h3>
        <p>${{ number_format($totalCommission, 2) }}</p>
    </div>
    <div class="summary-card">
        <h3>Total You Earned</h3>
        <p>${{ number_format($totalGuidePayment, 2) }}</p>
    </div>
</div>

<hr>

<h3>Completed Tours - {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}</h3>
@if ($revenues->count())
    <table class="calendar-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Tour</th>
                <th>Tourist</th>
                <th>Income</th>
                <th>Commission</th>
                <th>Your Earning</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revenues as $r)
                <tr>
                    <td>{{ $r->date }}</td>
                    <td>{{ $r->tour->name ?? 'Tour deleted' }}</td>
                    <td>{{ $r->tourist->name ?? 'Tourist deleted' }}</td>
                    <td>${{ number_format($r->income, 2) }}</td>
                    <td>${{ number_format($r->commission, 2) }}</td>
                    <td>${{ number_format($r->guide_payment, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No revenue for this month.</p>
@endif
@endsection
