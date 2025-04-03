<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pages</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script> <!-- Alpine.js -->
    <script>
    function copyToClipboard(url, button) {
        const el = document.createElement('textarea');
        el.value = url;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);

        // Change the button text to "Link Copied"
        button.textContent = 'Link Copied';

        // Reset the button text after 2 seconds
        setTimeout(() => {
            button.textContent = 'Copy Link';
        }, 2000);
    }
    </script>
    <!-- Vite includes Tailwind CSS -->
    @vite(['resources/css/app.css'])
</head>
@include('includes.nav')

<body class="bg-gray-50 flex justify-center items-center">

    <div class="w-full flex justify-center mt-10 px-4">
        <div class="  w-full sm:w-[1000px]"
            x-data="{ openLandingPageModal: false, subdomain: '{{ Auth::user()->subdomain }}', page_id: '1' }">


           
            <!-- Success Message -->
            @if(session('success'))
            <div id="success-message"
                class="flex w-full overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
                <div class="flex items-center justify-center w-12 bg-emerald-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                        <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>

            <script>
            // Hide the success message after 3 seconds
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
            </script>
            @endif


            <!-- Buttons: Create Landing Page and Update Subdomain -->
            @if (Auth::user()->is_admin == 1)
            <!-- Page Title -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Create Landing Page</h2>

            <div class="flex justify-center mb-6 space-x-4">
                <!-- Create Landing Page Button (Modal) -->
                <button @click="openLandingPageModal = true"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    + Create Landing Page
                </button>

                <!-- Edit Page Button (Link) -->
                <a href="{{ route('landing.update-page') }}"
                    class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Edit Page
                </a>
            </div>


            <!-- Modal for Create Landing Page -->
            <div x-show="openLandingPageModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" x-cloak>
                <div class="bg-white p-8 rounded-lg shadow-xl w-96">
                    <h3 class="text-xl font-semibold mb-6 text-center">Create Landing Page</h3>

                    <form action="{{ route('create-landing-page') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Landing Title:</label>
                            <input type="text" name="landing_title" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Sales Funnel Title:</label>
                            <input type="text" name="funnel_title" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button" @click="openLandingPageModal = false"
                                class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition duration-300">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Sharable Links Section (Visible to Both Admin and Non-Admin) -->

            <div class="mt-6 w-full">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Your Sharable Links:</h3>
                <div class="space-y-4">
                    @foreach ($pages as $page)
                    <div class="flex items-center space-x-2">
                        <!-- Display Sharable Link -->
                        <div
                            class="bg-white p-4 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] w-full">
                            <!-- Generate URL dynamically using the page's subdomain -->
                            <a href="{{ url($user->subdomain . '/' . $page->page_id) }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $page->landing_title }}
                            </a>
                            <span class="text-gray-500 text-sm block mt-1">
                                {{ url($user->subdomain . '/' . $page->page_id) }}
                            </span>

                            <!-- Copy Link Button -->
                            <button type="button"
                                onclick="copyToClipboard('{{ url($user->subdomain . '/' . $page->page_id) }}', this)"
                                class="mt-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                                Copy Link
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</body>

</html>