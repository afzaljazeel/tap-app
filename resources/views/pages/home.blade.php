@extends('layouts.app')  <!-- Extends a main layout (create layouts/app.blade.php) -->

@section('title', 'Explore Sri Lanka')

@section('content')
    <header class="hero">
        <h1>Explore Sri Lanka</h1>
        <p>One tap away</p>
        
        <!-- Search Bar with Form -->
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query" placeholder="Search Locations..." class="search-input" />
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

    <h2>Popular Locations</h2>
    <div class="location-container">
    @if (!empty($locations) && is_iterable($locations))
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

        @if (!empty($reviews) && is_iterable($reviews))
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
                <p>No reviews to show right now.</p>

            @endif
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-container">

            @if(!empty($faq) && is_iterable($faq))
                @foreach ($faq as $question)
                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-text">{{ $question['question'] }}</span>
                            <span class="faq-icon">▼</span>
                        </button>
                        <p class="faq-answer">{{ $question['answer'] }}</p>
                    </div>
                @endforeach
            @else
                <p>No FAQs available at the moment.</p>
            @endif 

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
@endsection

<!-- Load Scripts -->
@section('scripts')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endsection
