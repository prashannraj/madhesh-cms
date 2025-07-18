<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <div class="min-h-screen flex flex-col items-center justify-center py-8 px-4">
        <h1 class="text-3xl font-bold mb-6">गुनासो दर्ता फारम</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('complaints.store') }}" class="w-full max-w-lg bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium" for="name">नाम</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium" for="address">ठेगाना</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium" for="mobile">मोबाइल नम्बर</label>
                <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
                @error('mobile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium" for="description">गुनासो विवरण</label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
                पेश गर्नुहोस्
            </button>
        </form>
    </div>

</body>
</html>
