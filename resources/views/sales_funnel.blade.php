<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->subdomain }}'s Sales Funnel</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 max-w-2xl text-center">
        <!-- Headline -->
        <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}'s Exclusive Offer</h1>

        <!-- Subheadline -->
        <p class="text-lg text-gray-600 mt-2">Discover how you can transform your life with this one-time opportunity.
        </p>

        <!-- Video -->
        <div class="mt-6">
            <iframe class="w-full h-64 rounded-lg shadow-md" src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                frameborder="0" allowfullscreen>
            </iframe>
        </div>

        <!-- Call-To-Action Button -->
        <a href="#"
            class="mt-6 inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-lg font-semibold shadow-md transition duration-300">
            Get Started Now
        </a>
    </div>

</body>

</html>