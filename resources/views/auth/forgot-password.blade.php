
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css'])
</head>

@include('includes.main-header')

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-2">
    <div class="bg-white p-8 rounded-lg shadow-md w-[90%] max-w-[400px] mx-auto">
        <h2 class="text-2xl font-bold text-center mb-4">Forgot Password</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-400 p-3 rounded-md mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.check') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700">Enter your registered email:</label>
                <input type="email" id="email" name="email" required class="w-full p-2 border rounded-md">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
                Continue
            </button>
        </form>
    </div>
</body>
</html>
