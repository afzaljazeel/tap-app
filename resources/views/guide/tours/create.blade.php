@php
    $showSidebar = false;
@endphp

@extends('layouts.guide')

@section('content')
<div class="tour-create-form">
    <h2>Create New Tour</h2>

    <form method="POST" action="{{ route('guide.tours.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="name">Tour Name</label>
        <input type="text" name="name" required>

        <label for="details">Details</label>
        <textarea name="details" required></textarea>

        <label for="duration">Duration</label>
        <input type="text" name="duration" placeholder="Eg: 2hr - 3hr" required>

        <label for="amount">Amount ($)</label>
        <input type="number" name="amount" step="0.01" required>

        <label for="picture">Tour Image</label>
        <input type="file" name="picture" accept="image/*" required>

        <button type="submit" class="btn btn-primary">Create Tour</button>
    </form>
</div>
@endsection
