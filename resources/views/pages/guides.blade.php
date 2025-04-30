<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guides - Tap a Guide</title>
    <!-- Include Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-50">

    <!-- Navigation Bar -->
    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="bg-green-500 text-white text-center py-24">
        <h1 class="text-5xl font-bold">Meet Our Expert Guides</h1>
        <p class="mt-4 text-xl">Connect with certified local guides to explore Sri Lanka</p>
    </section>

    <!-- Guides Section -->
    <section class="py-16 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Our Guides</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @if($guides->isEmpty())
                    <p class="text-lg text-gray-600">No guides available at the moment.</p>
                @else
                    @foreach ($guides as $guide)
                    <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="{{ asset($guide->profile_image) }}" alt="{{ $guide->user->name }}" class="w-full h-64 object-cover rounded-lg mb-4">
                        
                        <!-- Accessing the name from the associated user -->
                        <h3 class="text-xl font-semibold text-gray-800">{{ $guide->user->name }}</h3>
                    
                        <p class="mt-2 text-gray-600">{{ $guide->specialization }}</p>
                        <p class="mt-2 text-gray-500">{{ $guide->bio }}</p>
                        <p class="mt-2 text-gray-500">Location: {{ $guide->location }}</p>
                        <a href="{{ route('guide.show', $guide->id) }}" class="mt-4 inline-block bg-green-500 text-white py-2 px-6 rounded-full font-semibold hover:bg-green-600">View Profile</a>
                    </div>
                    
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="bg-green-500 text-white py-16 text-center">
        <h2 class="text-3xl font-semibold mb-4">Get in Touch</h2>
        <p class="text-lg">Have any questions or need assistance? Reach out to us!</p>
        <a href="mailto:info@tapaguide.com" class="mt-4 inline-block bg-white text-green-500 py-2 px-6 rounded-full font-semibold hover:bg-green-100">Contact Us</a>
    </section>

</body>

</html>
