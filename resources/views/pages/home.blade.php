@extends('layouts.app')  <!-- Extends a main layout (create layouts/app.blade.php) -->

@section('title', 'Explore Sri Lanka')

@section('content')
    <header class="hero">
        <h1>Explore Sri Lanka</h1>
        <p>One tap away</p>
        <input type="text" placeholder="Search Locations...">
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
        @foreach ($locations as $location)
            <div class="location-card">
            <img src="{{ asset($location['image']) }}" alt="{{ $location['name'] }}">
            <h3>{{ $location['name'] }}</h3>
            </div>
        @endforeach
    </div>
</section>

    <!-- Reviews Section -->
    <section class="reviews">
        <h2>Our Reviews</h2>
        <div class="review-container">
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
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-container">
            @foreach ($faqs as $faq)
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span class="faq-text">{{ $faq['question'] }}</span>
                        <span class="faq-icon">▼</span>
                    </button>
                    <p class="faq-answer">{{ $faq['answer'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection

<!-- Load Scripts -->
@section('scripts')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endsection
