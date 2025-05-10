@php
    $showSidebar = true;
    $route = Route::currentRouteName();
@endphp

@extends('layouts.admin')

@section('title', 'Platform Revenue')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h2>💰 Platform Revenue</h2>
    <p>View total income, commissions, and payouts to guides.</p>
</div>


<!-- Revenue Summary -->
<div class="revenue-summary">
    <div class="summary-card">
        <h4>Total Income</h4>
        <p class="count">${{ number_format($totalIncome, 2) }}</p>
    </div>
    <div class="summary-card">
        <h4>Total Commission</h4>
        <p class="count">${{ number_format($totalCommission, 2) }}</p>
    </div>
    <div class="summary-card">
        <h4>Total Guide Payout</h4>
        <p class="count">${{ number_format($totalGuidePayout, 2) }}</p>
    </div>
</div>

<!-- Revenue Table -->
<div class="card">
    @if($revenues->count())
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Guide</th>
                    <th>Tourist</th>
                    <th>Tour</th>
                    <th>Income</th>
                    <th>Commission</th>
                    <th>Guide Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenues as $revenue)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($revenue->date)->format('M d, Y') }}</td>
                        <td>{{ $revenue->guide->user->name ?? 'Guide Deleted' }}</td>
                        <td>{{ $revenue->tourist->name ?? 'Tourist Deleted' }}</td>
                        <td>{{ $revenue->tour->name ?? 'Tour Deleted' }}</td>
                        <td>${{ number_format($revenue->income, 2) }}</td>
                        <td>${{ number_format($revenue->commission, 2) }}</td>
                        <td>${{ number_format($revenue->guide_payment, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No revenue records yet.</p>
    @endif
</div>
@endsection
