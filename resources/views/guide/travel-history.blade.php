@extends('layouts.guide')
@section('title', 'Travel History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guide-history.css') }}">

<div class="dashboard-header">
    <h2>📜 Travel History</h2>
    <p>View your completed tour records.</p>
</div>

@if($completed->isEmpty())
    <p class="empty-msg">No completed tours yet.</p>
@else
    <div class="history-cards">
        @foreach ($completed as $tour)
            <div class="history-card">
                <h3>{{ $tour->tour->name ?? 'Tour Deleted' }}</h3>
                <p><strong>Tourist:</strong> {{ $tour->tourist->name ?? 'Tourist Deleted' }}</p>
                <p><strong>Date:</strong> {{ $tour->date }} | <strong>Time:</strong> {{ $tour->preferred_time }}</p>
                <p><strong>Status:</strong> {{ $tour->status }}</p>
            </div>
        @endforeach
    </div>
@endif
@endsection
