


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toolbar</title>
    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Toolbar Header -->
    <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Left: Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-lg font-bold text-gray-800">MyBrand</a>
                </div>

                <!-- Center: Navigation Links -->
                <!-- Center: Navigation Links -->
                    <nav class="hidden md:flex space-x-6">
                        <a href="{{ route('admin.manage-users') }}" class="text-gray-600 hover:text-blue-500">Users</a>
                        <a href="{{ route('admin.upload-playlist') }}" class="text-gray-600 hover:text-blue-500">Upload Playlist</a>
                    </nav>

                  
               
                <!-- Right: Profile Section -->
                <div class="relative flex items-center space-x-4">
                    
                    <!-- User Greeting -->
                    <h2 class="text-sm font-medium text-gray-700">
                         {{ explode(' ', auth()->user()->name)[0] }}
                    </h2>

                    

                    <!-- Profile Picture & Dropdown -->
                    <button id="profile-btn" class="flex items-center space-x-2 focus:outline-none">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Photo" class="h-8 w-8 object-cover rounded-full">
                        @else
                            <img src="{{ asset('storage/profile_photos/default.png') }}" alt="Default Profile Photo" class="h-8 w-8 object-cover rounded-full">
                        @endif
                    </button>

                    <!-- Dropdown Menu -->
<div id="dropdown-menu" class="absolute right-0 mt-[150px] w-[150px] bg-white border border-gray-200 shadow-md rounded-md hidden">
  

    <!-- Fix: Correct Profile Edit Link -->
    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
    </form>
</div>

                <!-- Mobile Menu Button -->
                <button id="menu-btn" class="md:hidden focus:outline-none">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="md:hidden hidden bg-white ">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">DASHBOARD</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">FUNNEL</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">CRM</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">DM-MATERIALS</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-20 mx-auto max-w-7xl">

       
    </main>

    <script>
        // Toggle Mobile Menu
        document.getElementById("menu-btn").addEventListener("click", function() {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        });

        // Toggle Profile Dropdown
        document.getElementById("profile-btn").addEventListener("click", function() {
            document.getElementById("dropdown-menu").classList.toggle("hidden");
        });
    </script>

</body>
</html>
