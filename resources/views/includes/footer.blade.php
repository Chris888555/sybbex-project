<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>

    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col">
    <main class="flex-grow">
        <!-- Dito ilalagay ang main content ng page -->
    </main>

    <!-- Enhanced Footer with Top Shadow -->
    <section class="bg-gray-50 border-t border-gray-200 py-12 relative before:absolute before:top-0 before:left-0 before:w-full before:h-[1px] before:shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
        <div class="max-w-screen-xl mx-auto px-6 ">
            <!-- Navigation Links -->
            <nav class="flex flex-wrap justify-center gap-6 text-gray-600 text-sm font-medium">
                <a href="#" class="hover:text-gray-900 transition">About</a>
                <a href="#" class="hover:text-gray-900 transition">Blog</a>
                <a href="#" class="hover:text-gray-900 transition">Team</a>
                <a href="#" class="hover:text-gray-900 transition">Pricing</a>
                <a href="#" class="hover:text-gray-900 transition">Contact</a>
                <a href="#" class="hover:text-gray-900 transition">Terms</a>
            </nav>

            <!-- Social Media Icons -->
            <div class="flex justify-center space-x-6 mt-10"> 
                <a href="#" class="text-gray-500 hover:text-blue-500 transition">
                    <i class="fa-brands fa-facebook text-2xl"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-400 transition">
                    <i class="fa-brands fa-twitter text-2xl"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-red-500 transition">
                    <i class="fa-brands fa-youtube text-2xl"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-pink-600 transition">
                    <i class="fa-brands fa-instagram text-2xl"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-black transition">
                    <i class="fa-brands fa-github text-2xl"></i>
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-center text-gray-400 text-sm mt-6">
                &copy; 2025 Your Company. All rights reserved.
            </p>
        </div>
    </section>

    <!-- Font Awesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</body>

</html>