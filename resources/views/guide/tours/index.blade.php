@php
    $showSidebar = true;
@endphp

@extends('layouts.guide')

@section('content')
<div class="dashboard-content">
    <h2>Your Created Tours</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="tour-actions">
        <a href="{{ route('guide.tours.create') }}" class="create-tour-btn">+ Create New Tour</a>
    </div>

    <div class="tour-grid">
        @foreach ($tours as $tour)
            <div class="tour-card">
                <img src="{{ asset('storage/' . $tour->picture) }}" alt="Tour Image">
                <div class="tour-info">
                    <h3>{{ $tour->name }}</h3>
                    <p><strong>Amount:</strong> ${{ $tour->amount }}</p>
                    <p><strong>Duration:</strong> {{ $tour->duration }}</p>
                    <form method="POST" action="{{ route('guide.tours.destroy', $tour->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
