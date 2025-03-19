<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy | Video Playlist</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css'])

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <!-- Main Header -->
    @include('includes.student-header')

    <!-- Main Content Section -->
    <div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8">
        <h1 class="text-4xl font-extrabold text-left mb-8 
           bg-gradient-to-r from-blue-500 to-purple-600 text-transparent bg-clip-text
           drop-shadow-lg tracking-wide uppercase relative inline-block">
            DW Academy

        </h1>


        <!-- Check if playlists are available -->
        @if($playlists->isEmpty())
        <p class="text-center text-lg text-gray-700">No playlists available.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($playlists as $playlist)
            <!-- Video Card -->

            <div class="bg-white rounded-lg shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px] overflow-hidden p-[10px]">
                <!-- Thumbnail Wrapper (Only this gets overlay) -->
                <div class="relative group cursor-pointer" onclick="openModal('{{ $playlist->video_link }}')">
                    <!-- Thumbnail Image -->
                    @if($playlist->thumbnail_url)
                    <img src="{{ asset('storage/' . $playlist->thumbnail_url) }}" alt="{{ $playlist->title }}"
                        class="w-full h-auto object-cover ">
                    @else
                    <img src="https://via.placeholder.com/150" alt="No Thumbnail" class="w-full h-auto object-cover">
                    @endif

                    <!-- Play Button Overlay (Appears on Hover) -->
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="h-12 w-12 text-white opacity-90 hover:opacity-100 transition-all" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Video Title (Outside the Overlay, Inside the Card) -->
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="h-6 w-6 text-violet-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18" />
                            <line x1="7" y1="2" x2="7" y2="22" />
                            <line x1="17" y1="2" x2="17" y2="22" />
                            <line x1="2" y1="12" x2="22" y2="12" />
                            <line x1="2" y1="7" x2="7" y2="7" />
                            <line x1="2" y1="17" x2="7" y2="17" />
                            <line x1="17" y1="17" x2="22" y2="17" />
                            <line x1="17" y1="7" x2="22" y2="7" />
                        </svg>
                        {{ $playlist->title }}
                    </h3>

                    <!-- Reaction Buttons -->
                    <div class="flex items-center gap-4 mt-3">
                        <!-- Heart (Love) Reaction -->
                        <button class="flex items-center gap-1 text-gray-600 hover:text-red-500 transition">
                            <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7" />
                            </svg>
                            <span class="text-sm">Love</span>
                        </button>

                        <!-- Like Reaction -->
                        <button class="flex items-center gap-1 text-gray-600 hover:text-blue-500 transition">
                            <svg class="h-6 w-6 text-blue-500" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
                            </svg>
                            <span class="text-sm">Like</span>
                        </button>
                    </div>
                </div>


            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="videoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden">
        <!-- Close Button -->


        <button id="closeModal" class="absolute top-[80px] right-2 text-gray-600 hover:text-gray-900 text-2xl z-50">
            <svg class="h-8 w-8 text-yellow-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                <line x1="9" y1="9" x2="15" y2="15" />
                <line x1="15" y1="9" x2="9" y2="15" />
            </svg>
        </button>



        <!-- Video Container -->
        <div
            class="bg-white rounded-lg overflow-hidden relative w-[90%] max-w-3xl mx-auto shadow-[0_20px_50px_rgba(8,_112,_184,_0.7)]">

            <div class="p-2">
                <div class="relative" style="padding-top: 56.25%;">
                    <iframe id="videoIframe" class="absolute top-0 left-0 w-full h-full" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
    function isYouTube(url) {
        return /(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/.test(url);
    }

    function getYouTubeEmbedURL(url) {
        var matches = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
        return matches && matches[1] ? "https://www.youtube.com/embed/" + matches[1] + "?autoplay=0" : url;
    }

    function openModal(videoLink) {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoIframe');
        const embedUrl = isYouTube(videoLink) ? getYouTubeEmbedURL(videoLink) : videoLink;

        iframe.src = embedUrl;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoIframe');
        iframe.src = '';
        modal.classList.add('hidden');
    }

    document.getElementById('closeModal').addEventListener('click', closeModal);

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('videoModal');
        if (event.target === modal) {
            closeModal();
        }
    });
    </script>
</body>

</html>