<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Facebook Link</title>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8">
        <!-- Back to Funnel Main Button -->
        <div class="mb-4">
            <a href="{{ route('funnel.main') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                <!-- Using the provided SVG icon (Arrow pointing left) -->
                <svg class="h-6 w-6 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <line x1="5" y1="12" x2="9" y2="16" />
                    <line x1="5" y1="12" x2="9" y2="8" />
                </svg>
                Back to Funnel Main
            </a>
        </div>

        <!-- Success message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 text-gray-500 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-2xl font-semibold mb-4">Update Facebook Link</h1>

        <!-- Form to update the Facebook link -->
        <form action="{{ route('save-funnel') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="facebook_link" class="block text-lg font-medium">Facebook Link</label>
                <input 
                    type="url" 
                    name="facebook_link" 
                    id="facebook_link" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg"
                    value="{{ old('facebook_link', $user->facebook_link) }}" 
                    required
                >
                @error('facebook_link')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update Facebook Link</button>
        </form>
    </div>
</body>

</html>
