<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex flex-col h-screen bg-gray-100 ">

    <!-- Main Container with Top Bar and Sidebar -->
    <div class="flex flex-1">

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-[#353185] shadow-md w-[300px] h-full fixed top-0 left-0 z-10 transform -translate-x-full md:translate-x-0 transition-transform duration-300">

            <div class="p-6 flex flex-col h-full">
                <!-- Logo Section -->
                <div class="mb-8">
                    <h1 class="text-2xl font-semibold text-gray-100 ">MyLogo</h1> <!-- Text-based Logo -->
                </div>

                <!-- Navigation Links with SVG Icons -->
                <nav class="flex flex-col space-y-4">
    <a href="{{ route('dashboard') }}" class="nav-link text-gray-100 hover:text-gray-900 hover:bg-gray-200 p-3 rounded-md flex items-center space-x-3 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
        </svg>
        <span class="text-sm font-semibold transition-colors duration-300">Dashboard</span>
    </a>

    <a href="{{ route('funnel') }}" class="nav-link text-gray-100 hover:text-gray-900 hover:bg-gray-200 p-3 rounded-md flex items-center space-x-3 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16M6 4l6 16 6-16"></path>
        </svg>
        <span class="text-sm font-semibold transition-colors duration-300">Funnel</span>
    </a>

    <a href="{{ route('profile.upload') }}" class="nav-link text-gray-100 hover:text-gray-900 hover:bg-gray-200 p-3 rounded-md flex items-center space-x-3 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span class="text-sm font-semibold transition-colors duration-300">Upload Profile</span>
    </a>
</nav>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('mouseenter', () => {
            document.querySelectorAll('.nav-link').forEach(el => {
                el.classList.remove('active');
                el.querySelector('.icon').classList.remove('active-icon'); // Reset SVG color
            });
            link.classList.add('active');
            link.querySelector('.icon').classList.add('active-icon'); // Change SVG color
        });
    });
</script>

<style>
    .nav-link.active {
        background-color: #E5E7EB; /* Gray-200 */
        color: #111827; /* Gray-900 */
    }
    .nav-link.active .icon {
        stroke: #111827; /* Change SVG icon color */
    }
</style>

            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="absolute left-[300px] w-[calc(100%-300px)] h-full min-h-screen bg-white transition-all duration-500 ml-0">
 

            <!-- Top Bar -->
             
            <toolbar class="w-full h-[60px] flex items-center justify-between px-[10px] bg-white shadow-md">


                <button class="md:hidden p-2" id="burger-icon" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-gray-800"></i>
                </button>

                <!-- Profile and Name aligned to the right -->
                <div class="text-gray-800 flex items-center space-x-3 ml-auto">
                    <!-- Smaller Text for Name -->
                    <h2 class="text-sm font-medium text-gray-700">Welcome, {{ auth()->user()->name }} 👋</h2>

               
                
                 <a href="{{ route('dashboard') }}">
                        @if($user && $user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Photo" class="h-8 w-8 object-cover rounded-full">
                        @else
                            <img src="{{ asset('storage/' . ($user->profile_picture ? $user->profile_picture : 'profile_photos/' . $user->default_profile)) }}" alt="Default Profile Photo" class="h-8 w-8 object-cover rounded-full">
                        @endif
                    </a>
                   
                </div>

            

               
</toolbar>

          

    <!-- Scripts -->
    
</body>
</html>
