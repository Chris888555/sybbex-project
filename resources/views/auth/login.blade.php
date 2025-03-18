<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <style>
        .body-bg {
            background-color: #ffffff;
        }
    </style>
</head>
<body class="body-bg h-screen flex items-center justify-center px-4" style="font-family:'Lato',sans-serif;">
<main class="bg-white w-[95%] sm:w-[600px] md:w-[700px] lg:w-[500px] p-8 rounded-lg shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
    <section>
        <h3 class="font-bold text-2xl text-gray-800 text-left">Sign In</h3>
        <p class="text-gray-600 pt-2 text-left">Welcome back! Please log in to your account.</p>
    </section>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 border border-red-400 p-2 sm:p-2 rounded-md mt-3 sm:mt-5 max-w-[100%] sm:max-w-lg mx-auto text-sm sm:text-base">
        <ul class="list-disc pl-4 sm:pl-5">
            @foreach ($errors->all() as $error)
                <li class="flex items-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#EF4444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
    


    <section class="mt-10">
        <form class="flex flex-col" method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                <input type="email" id="email" name="email" required class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
            </div>

            <div class="mb-6 pt-3 rounded bg-gray-200 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                <input type="password" id="password" name="password" required class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3 pr-10">
                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePassword('password', 'eyeIcon')">
                    <i id="eyeIcon" class="fas fa-eye text-gray-600"></i>
                </span>
            </div>

            <button class="bg-gradient-to-br from-indigo-600 to-purple-500 text-white font-bold py-4 rounded shadow-lg hover:shadow-xl transition duration-200 hover:from-indigo-700 hover:to-purple-600" type="submit">
                Login
            </button>
        </form>
    </section>

    <div class="text-center mt-6">
        <p class="text-gray-800">Don't have an account? <a href="{{ route('register') }}" class="font-bold hover:underline">Sign up</a>.</p>
    </div>
</main>

<script>
    function togglePassword(fieldId, iconId) {
        const passwordField = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>