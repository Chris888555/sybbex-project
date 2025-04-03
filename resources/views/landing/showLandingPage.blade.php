<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $landingPage->landing_title }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
    <!-- Tailwind CSS -->
    <style>
        /* Remove background color from inputs and set transparent */
        input {
            background-color: transparent;
        }
    </style>
</head>

<body class="font-sans min-h-screen flex flex-col bg-gray-800">

    <div class="container mx-auto px-6 py-10 sm:py-24 flex-grow">

        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="text-5xl font-extrabold text-gray-200 leading-[45px] sm:leading-6 md:leading-snug">
                {!! json_decode($landingPage->landing_content)->headline !!}
            </div>

            <div class="mt-4 text-2xl sm:max-w-[800px] m-auto text-gray-200 opacity-80">
                {!! json_decode($landingPage->landing_content)->subheadline !!}
            </div>
        </div>

        <!-- Form Section -->
        <div class="">
            <h2 class="text-lg md:text-xl mb-6 text-center text-gray-200 mb-6">Enter your details below to view the details and get updates
            </h2>

            <!-- Form -->
            <form class="max-w-lg mx-auto flex flex-col items-center"
                action="{{ route('submit.form', ['subdomain' => $subdomain, 'page_id' => $landingPage->page_id]) }}"
                method="POST">
                @csrf
                <!-- Name Field -->
                <input type="text" id="name" name="name" placeholder="Enter your name"
                    class="text-gray-100 w-full p-4 mb-4 rounded-md border-2 border-gray-300 text-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>

                <!-- Email Input -->
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="text-gray-100 w-full p-4 mb-4 rounded-md border-2 border-gray-300 text-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>

                <!-- Phone Input -->
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number"
                    class="text-gray-100 w-full p-4 mb-4 rounded-md border-2 border-gray-300 text-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>

                <button type="submit"
                    class=" w-full sm:max-w-[400px] bg-yellow-500 text-gray-700 px-6 py-3 rounded-lg text-lg font-semibold transition transform hover:scale-105">
                    Get Free Access
                </button>
            </form>
        </div>
        <p class="text-sm mt-4 m-auto text-center sm:max-w-[400px] text-gray-100">
            Your details are secure with us. We value your privacy and ensure that all your information is kept confidential.
        </p>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-700 text-white py-6 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
