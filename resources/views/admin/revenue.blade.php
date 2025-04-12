@php
    $showSidebar = false;
@endphp

@extends('layouts.app')

@section('title', 'Platform Revenue')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-dashboard.css') }}">

<div class="dashboard-header">
    <h2>Platform Revenue</h2>
    <p>View total income, commissions, and guide payouts.</p>
</div>

<div class="revenue-summary">
    <div class="summary-card">
        <h3>Total Income</h3>
        <p>${{ number_format($totalIncome, 2) }}</p>
    </div>
    <div class="summary-card">
        <h3>Total Commission</h3>
        <p>${{ number_format($totalCommission, 2) }}</p>
    </div>
    <div class="summary-card">
        <h3>Total Guide Payout</h3>
        <p>${{ number_format($totalGuidePayout, 2) }}</p>
    </div>
</div>

<div class="card">
    @if($revenues->count())
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Guide</th>
                    <th>Tourist</th>
                    <th>Tour</th>
                    <th>Total Income</th>
                    <th>Commission</th>
                    <th>Guide Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenues as $revenue)
                    <tr>
                        <td>{{ $revenue->date }}</td>
                        <td>{{ $revenue->guide->user->name ?? 'N/A' }}</td>
                        <td>{{ $revenue->tourist->name ?? 'N/A' }}</td>
                        <td>{{ $revenue->tour->name ?? 'N/A' }}</td>
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
