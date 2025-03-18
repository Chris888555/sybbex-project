<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>

<header class="bg-white shadow-md py-4 fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- Left: Navigation Links -->
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500 font-semibold transition">Home</a>
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 font-semibold transition">Login</a>
            <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500 font-semibold transition">Sign Up</a>
        </nav>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Right: Logo -->
        <div>
            <a href="{{ route('home') }}">
                <img src="https://tse4.mm.bing.net/th?id=OIP.BBuCygxvIN0VF8eDBaqSlQHaFj&pid=Api&P=0&h=220" 
                     alt="Logo" class="h-[40px] h-[40px] object-contain">
            </a>
        </div>
    </div>

    <!-- Mobile Navigation Dropdown -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-md absolute w-full left-0 top-[60px] p-4">
        <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-500 font-semibold">Home</a>
        <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-blue-500 font-semibold">Login</a>
        <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-blue-500 font-semibold">Sign Up</a>
    </div>
</header>

<script>
    // Mobile Menu Toggle
    document.getElementById('menu-toggle').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>


<body>
    
</body>
</html>