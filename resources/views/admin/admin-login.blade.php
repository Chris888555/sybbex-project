<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-[90%] max-w-[450px]">

        <h2 class="text-2xl font-bold mb-4 text-center">Admin Login</h2>

        @if ($errors->any() || session('error'))
    <div class="bg-red-100 text-red-700 border border-red-400 p-3 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @if (session('error'))
                <li>{{ session('error') }}</li>
            @endif
        </ul>
    </div>
@endif
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password </label>
                <input type="password" name="password" id="password" required minlength="3"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Login
            </button>
        </form>
    </div>
    <p class="fixed bottom-4 left-1/2 transform -translate-x-1/2 text-center text-gray-600 mt-4">
        You are an admin? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login As Student</a>
    </p>

</body>
</html>
