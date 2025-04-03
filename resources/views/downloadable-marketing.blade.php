<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloadable Marketing Content</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('includes.student-header')

<body class="bg-gray-100">

    <div class="container w-full max-w-7xl m-auto p-4 sm:p-8">
      

        @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-6 rounded-md">
            {{ session('success') }}
        </div>
        @endif

        <!-- Grid Layout with 5 images per row on PC -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-6">
            @foreach ($marketingContents as $content)
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <!-- Caption Display (at the top) -->
                <div class="max-h-16 overflow-auto p-4 bg-gray-100 border border-gray-300 rounded-lg">
                    <p id="caption-{{ $content->id }}" class="text-lg font-semibold">{{ $content->caption }}</p>
                </div>

                <!-- Copy Caption Button (separate container) -->
                <div class="text-center mt-4">
                    <button id="copy-{{ $content->id }}"
                        class="mb-4 px-4 py-2 bg-gradient-to-br from-indigo-600 to-purple-500 text-white rounded-md">Copy
                        Caption</button>
                </div>

                <!-- Image and Download Button (separate hover container) -->
                <div class="relative group">
                    <img src="{{ asset('storage/' . $content->image) }}" alt="Marketing Image"
                        class="w-full h-auto rounded-md mb-4">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-gray-900 bg-opacity-50">
                        <!-- Download Button -->
                        <a href="{{ asset('storage/' . $content->image) }}" id="download-{{ $content->id }}"
                            class="px-4 py-2 bg-gradient-to-br from-indigo-600 to-purple-500 text-white rounded-md flex items-center">
                            <svg class="h-5 w-5 text-slate-100 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
    // Function to handle copy caption with SweetAlert
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('button[id^="copy-"]');
        copyButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const contentId = button.id.split('-')[1]; // Extract content ID
                const caption = document.getElementById('caption-' + contentId).textContent;

                // Copy caption to clipboard
                copyCaption(caption);

                // Show SweetAlert when caption is copied
                Swal.fire({
                    icon: 'success',
                    title: 'Caption copied!',
                    text: 'The caption has been copied to your clipboard.',
                    timer: 2000, // Auto-close after 2 seconds
                    showConfirmButton: false,
                });
            });
        });
    });

    function copyCaption(caption) {
        if (caption) {
            navigator.clipboard.writeText(caption).then(function() {
                // No additional actions required as SweetAlert will notify user
            }).catch(function() {
                alert('Failed to copy caption!');
            });
        } else {
            alert('No caption to copy!');
        }
    }

    // Function to handle image download with SweetAlert
    document.addEventListener('DOMContentLoaded', function() {
        const downloadButtons = document.querySelectorAll('a[id^="download-"]');
        downloadButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                const downloadUrl = button.getAttribute('href'); // Get the download URL

                // Show SweetAlert before download
                Swal.fire({
                    icon: 'success',
                    title: 'Image is downloading!',
                    text: 'The image will be saved to your device shortly.',
                    timer: 2000, // Auto-close after 2 seconds
                    showConfirmButton: false,
                }).then(function() {
                    // Trigger the download after SweetAlert is closed
                    const link = document.createElement('a');
                    link.href = downloadUrl;
                    link.download = downloadUrl.split('/')
                .pop(); // Set the file name based on the URL
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link); // Remove the link after click
                });
            });
        });
    });
    </script>

</body>

</html>