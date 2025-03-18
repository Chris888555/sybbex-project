<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forex Trading Hub</title>
    @vite(['resources/css/app.css'])
</head>
@include('includes.main-header')

<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <!-- Main Content Wrapper -->
    <main class="flex-grow flex flex-col items-center justify-center mt-[10%]">
        <div class="p-8 w-11/12 max-w-4xl text-center">
            <h2
                class="text-2xl font-bold bg-gradient-to-br from-green-600 to-blue-500 text-transparent bg-clip-text mb-4">
                Welcome to the Forex Trading Hub
            </h2>
            <p class="text-gray-700 mb-6">Master the art of Forex trading with expert strategies, real-time market
                analysis, and a community of traders.</p>
            <div class="flex justify-center space-x-4">
                <a href="#"
                    class="bg-gradient-to-br from-green-600 to-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:from-green-700 hover:to-blue-600">
                    Start Trading
                </a>
                <a href="#" class="bg-gray-300 text-gray-900 px-6 py-2 rounded-lg shadow-md hover:bg-gray-400">
                    Learn More
                </a>
            </div>
        </div>
    </main>

    @include('includes.footer')

</body>

</html>