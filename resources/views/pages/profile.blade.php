<!-- resources/views/guides/profile.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $guide->user->name }} - Guide Profile</title>
    <!-- Include Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-50">

    <!-- Navigation Bar -->
    @include('layouts.navigation')

    <!-- Profile Section -->
    <section class="bg-white py-16 px-4">
        <div class="max-w-6xl mx-auto text-center">

            <!-- Guide Name and Specialization -->
            <h1 class="text-4xl font-semibold text-gray-800">{{ $guide->user->name }}</h1>
            <p class="text-lg mt-2 text-green-600">{{ $guide->specialization }}</p>

            <!-- Profile Image -->
            <div class="mt-8 flex justify-center">
                <img src="{{ asset($guide->profile_image) }}" alt="{{ $guide->user->name }}" class="w-48 h-48 object-cover rounded-full border-4 border-green-500 shadow-lg">
            </div>

            <!-- Guide Bio -->
            <div class="text-left max-w-3xl mx-auto mt-8">
                <h2 class="text-2xl font-semibold text-gray-800">About Me</h2>
                <p class="mt-4 text-gray-600 text-lg leading-relaxed">{{ $guide->bio }}</p>
            </div>

            <!-- Location -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800">Location: <span class="text-green-600">{{ $guide->location }}</span></h3>
            </div>

            <!-- Contact Information -->
            <div class="mt-8 flex justify-center gap-6">
                <a href="tel:{{ $guide->phone_number }}" class="bg-green-500 text-white py-2 px-6 rounded-full font-semibold hover:bg-green-600 transition-colors duration-200">Call Me</a>
                <a href="mailto:{{ $guide->user->email }}" class="bg-blue-500 text-white py-2 px-6 rounded-full font-semibold hover:bg-blue-600 transition-colors duration-200">Email Me</a>
            </div>
        </div>
    </section>

    <!-- Footer (Optional) -->
    <footer class="bg-gray-800 text-white py-8 text-center">
        <p>&copy; 2025 Tap A Guide | All Rights Reserved</p>
    </footer>

</body>

</html>
