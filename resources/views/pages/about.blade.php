<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Tap a Guide</title>
    <!-- Include Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-50">

    <!-- Navigation Bar -->

    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="bg-green-500 text-white text-center py-24">
        <h1 class="text-5xl font-bold">About Tap a Guide</h1>
        <p class="mt-4 text-xl">Connecting you to certified travel guides across Sri Lanka</p>
    </section>

    <!-- Mission Section -->
    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Our Mission</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                At Tap a Guide, we are dedicated to connecting travelers with certified local guides across Sri Lanka. Our mission is to make it easy for you to find, book, and enjoy guided tours with experts who offer you a personalized experience. With our platform, you can explore Sri Lanka with peace of mind, knowing you're in expert hands.
            </p>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Our Core Values</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-2xl font-semibold text-green-500">Trust</h3>
                    <p class="mt-4 text-gray-600">We only partner with certified, experienced guides to ensure your journey is safe and enriching.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-2xl font-semibold text-green-500">Convenience</h3>
                    <p class="mt-4 text-gray-600">Our platform allows you to easily book guides for a seamless, hassle-free travel experience.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-2xl font-semibold text-green-500">Expertise</h3>
                    <p class="mt-4 text-gray-600">Our guides are locals who know Sri Lanka inside out, offering you insider knowledge that enhances your experience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">How It Works</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="bg-green-500 text-white p-4 rounded-full mx-auto mb-4">
                        <span class="text-3xl font-semibold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-green-500">Search</h3>
                    <p class="mt-4 text-gray-600">Browse a wide selection of local, certified guides and choose the perfect one for your trip.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="bg-green-500 text-white p-4 rounded-full mx-auto mb-4">
                        <span class="text-3xl font-semibold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-green-500">Book</h3>
                    <p class="mt-4 text-gray-600">Select your guide based on availability, preferences, and reviews, then book directly with ease.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="bg-green-500 text-white p-4 rounded-full mx-auto mb-4">
                        <span class="text-3xl font-semibold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-green-500">Enjoy</h3>
                    <p class="mt-4 text-gray-600">Meet your guide, explore exciting locations, and enjoy a memorable, customized tour experience.</p>
                </div>
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
