<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Playlist</title>
    @vite(['resources/css/app.css']) <!-- Include Vite compiled CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@include('includes.admin-header')
<body class="bg-white min-h-screen flex items-center justify-center">



    <!-- Playlist Upload Form -->
    <div class="w-[90%] max-w-lg mx-auto bg-white shadow-xl p-8 rounded-2xl border border-gray-200 mt-[100px]">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Upload Playlist Video</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 p-3 rounded-md mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-400 p-3 rounded-md mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to upload playlist -->
        <form action="{{ route('playlists.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                <input type="text" name="title" required class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
            </div>

            <!-- Video Link Input -->
            <div class="mb-4">
                <label for="video_link" class="block text-sm font-semibold text-gray-700">Video Link (YouTube or MP4)</label>
                <input type="url" name="video_link" required class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
            </div>

            <!-- Thumbnail Image Upload -->
            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700">Thumbnail Image </label>
                <input type="file" name="thumbnail" accept="image/*" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg text-gray-800">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-gradient-to-br from-indigo-600 to-purple-500 w-full text-white py-3 rounded-lg font-bold text-lg hover:bg-blue-700 transition-transform transform hover:scale-105 flex items-center justify-center space-x-2">
    <svg class="h-6 w-6 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
        <path stroke="none" d="M0 0h24v24H0z"/>  
        <path d="M7 18a4.6 4.4 0 0 1 0 -9h0a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />  
        <polyline points="9 15 12 12 15 15" />  
        <line x1="12" y1="12" x2="12" y2="21" />
    </svg>
    <span>Upload Playlist</span>
</button>

        </form>
    </div>

</body>
</html>
