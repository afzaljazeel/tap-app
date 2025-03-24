@extends('layouts.guide')

@section('content')
<div class="dashboard-content">
    <h2>Your Created Tours</h2>

    <a href="{{ route('guide.tours.create') }}" class="btn btn-success">+ Create New Tour</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Tour Name</th>
                <th>Amount</th>
                <th>Duration</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tours as $tour)
                <tr>
                    <td>{{ $tour->name }}</td>
                    <td>${{ $tour->amount }}</td>
                    <td>{{ $tour->duration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $tour->picture) }}" alt="Tour Image" width="80">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
