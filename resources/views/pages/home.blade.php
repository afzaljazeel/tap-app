@extends('layouts.app')

@section('title', 'Explore Sri Lanka')

@section('content')
<header class="hero">
    <h1>Explore Sri Lanka</h1>
    <p>One tap away</p>

    <!-- Search Bar with Form -->
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search Guides by location.." class="search-input" />
        <button type="submit" class="search-btn">Search</button>
    </form>
</header>

<section class="why-choose-us">
    <h2>Why Choose Us?</h2>
    <p>Find trusted, certified guides effortlessly. Our platform lets you book verified experts by destination,
       availability, and reviews, ensuring a reliable, personalized travel experience. Explore confidently with guides who 
       make your journey seamless and unforgettable.</p>
</section>

<!-- Locations Section -->
<section class="locations">
    <h2>Popular Locations</h2>
    <div class="location-container">
        @if(!empty($locations) && is_iterable($locations))
            @foreach ($locations as $location)
                <div class="location-card">
                    <img src="{{ asset($location['image']) }}" alt="{{ $location['name'] }}">
                    <h3>{{ $location['name'] }}</h3>
                </div>
            @endforeach
        @else
            <p>No locations available at the moment.</p>
        @endif
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews">
    <h2>Our Reviews</h2>
    <div class="review-container">
        @if(!empty($reviews) && is_iterable($reviews))
            @foreach ($reviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        <img src="{{ asset('img/reviewers/' . $review['profile_image']) }}" alt="Reviewer Image" class="reviewer-img">
                        <div class="stars">★★★★★</div> <!-- Star Ratings -->
                    </div>
                    <p class="review-text">"{{ $review['text'] }}"</p>
                    <h4 class="review-author">{{ $review['author'] }}</h4>
                </div>
            @endforeach
        @else
            <p>No reviews available at the moment.</p>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-container">
        @if (!empty($faqs) && is_iterable($faqs))
            @foreach ($faqs as $faq)
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span class="faq-text">{{ $faq['question'] }}</span>
                        <span class="faq-icon">▼</span>
                    </button>
                    <p class="faq-answer">{{ $faq['answer'] }}</p>
                </div>
            @endforeach
        @else
            <p>No FAQs found.</p>
        @endif
    </div>
</section>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-content">
        <img src="{{ asset('img/logo_high_res.png') }}" alt="Tap Logo" class="footer-logo">
        <p class="footer-slogan">Your Dream Tour, One Tap Away.</p>
        <p class="footer-contact">Contact: info@tapaguide.com</p>
        <p class="footer-rights">© 2025 Tap A Guide | All Rights Reserved</p>
    </div>
</footer>

@endsection

@section('scripts')
<script src="{{ asset('js/homepage.js') }}"></script>
@endsection
