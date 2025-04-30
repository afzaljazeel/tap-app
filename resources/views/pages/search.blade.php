<!-- resources/views/search.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Sri Lanka</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <!-- Include the navigation -->
    @include('layouts.navigation')

    <div class="container mx-auto px-4 py-10">
        <h1 class="text-4xl font-extrabold text-center text-green-700 mb-8">Explore Sri Lanka</h1>

        <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto mb-10">
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Search destinations, attractions, or cities..."
                    class="w-full px-4 py-2 focus:outline-none"
                >
                <button type="submit" class="bg-green-600 text-white px-6 py-2 hover:bg-green-700 transition-all">
                    Search
                </button>
            </div>
        </form>

        @if(isset($guides) && count($guides))
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">
                    Found {{ count($guides) }} guide(s) in "<span class="text-green-600">{{ $query }}</span>":
                </h2>

                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-green-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">Guide Name</th>
                                <th class="px-4 py-2 text-left">Location</th>
                                <th class="px-4 py-2 text-left">Phone</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Certifications</th>
                                <th class="px-4 py-2 text-left">Experience</th>
                                <th class="px-4 py-2 text-left">Languages</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                @foreach($guides as $guide)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="px-4 py-2">{{ $guide->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $guide->location ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $guide->user->phone ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $guide->user->email ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $guide->certifications ?? 'Not specified' }}</td>
                                        <td class="px-4 py-2">{{ $guide->experience ?? 'Not mentioned' }}</td>
                                        <td class="px-4 py-2">{{ $guide->languages ?? 'Not listed' }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('guide.show', $guide->id) }}" class="mt-4 inline-block bg-green-500 text-white py-2 px-6 rounded-full font-semibold hover:bg-green-600">View Profile</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif(request('query'))
            <p class="text-center text-gray-500 mt-12">No guides found in "<strong>{{ request('query') }}</strong>".</p>
        @endif
    </div>

</body>
</html>
