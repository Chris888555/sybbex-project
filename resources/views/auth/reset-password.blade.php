<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite(['resources/css/app.css'])
</head>

@include('includes.main-header')

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-2">
    <div class="bg-white p-8 rounded-lg shadow-md w-[90%] max-w-[400px] mx-auto">
        <h2 class="text-2xl font-bold text-center mb-4">Reset Password</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-400 p-3 rounded-md mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label for="password" class="block text-gray-700">New Password:</label>
                <input type="password" id="password" name="password" required class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700">Confirm New Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full p-2 border rounded-md">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
                Reset Password
            </button>
        </form>
    </div>
</body>
</html>
