<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Explore Sri Lanka</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>
<body>

@include('layouts.navigation')

<div class="container">
    <h1 class="page-title">Explore Sri Lanka</h1>

    <form action="{{ route('search') }}" method="GET" class="search-form">
        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search locations...">
        <button type="submit">Search</button>
    </form>

    @if(isset($guides) && count($guides))
        <h2 class="result-title">Found {{ count($guides) }} guide(s) in "<span class="highlight">{{ $query }}</span>"</h2>

        <div class="guide-grid">
            @foreach($guides as $guide)
                <div class="guide-card">
                    <img src="{{ $guide->profile_picture ? asset('storage/' . $guide->profile_picture) : asset('img/profile-placeholder.png') }}"
                         alt="Guide Picture" class="guide-img">

                    <div class="guide-info">
                        <h3>{{ $guide->user->name ?? 'Unnamed' }}</h3>
                        <p>{{ $guide->location }}</p>
                        <a href="{{ route('tourist.guide.tours', $guide->id) }}" class="view-btn">View Profile</a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(request('query'))
        <p class="no-result">No guides found in "<strong>{{ request('query') }}</strong>".</p>
    @endif
</div>

</body>
</html>
