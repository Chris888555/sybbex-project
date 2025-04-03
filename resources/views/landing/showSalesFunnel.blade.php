<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funnel Page</title>

    <!-- Add Tailwind CSS via Vite -->
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 flex items-center justify-center ">

    <div class="container max-w-6xl p-8 ">

        <?php $funnelContent = json_decode($funnelPage->funnel_content); ?>
        
    <!-- Headline -->
    <h1 class="text-center mb-4 text-4xl font-extrabold text-gray-700 leading-[45px] sm:leading-6 md:leading-snug">{!! $funnelContent->headline !!}</h1>

    <!-- Subheadline -->
    <p class="sm:max-w-[800px] m-auto text-xl text-gray-600 text-center mb-8">{!! $funnelContent->subheadline !!}</p>

   <!-- Chat Group Link -->
<div class="text-center mt-8">
    <a href="{{ $funnelContent->chat_group_link }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
        <!-- Icon -->
        <svg class="h-6 w-6 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
        Join Our Chat Group
    </a>
</div>



  <div class="container w-full flex flex-col sm:flex-row sm:max-w-6xl sm:p-8 mt-10">
    <!-- Property Image (Left) -->
    <div class="w-full sm:w-[70%] sm:pr-8 mb-6">
        <img class="w-full rounded-lg shadow-lg transition-all duration-300 hover:scale-105" 
             src="{{ $funnelContent->property_image }}" alt="Property Image">
    </div>

    <!-- Floor Plan Images (Right) -->
    <div class="w-full sm:w-1/2">
        <div class="gap-4 sm:grid grid-cols-2 sm:gap-6">
            @foreach ($funnelContent->floor_images as $floorImage)
                <img class="w-full h-auto rounded-lg shadow-md transition-all duration-300 hover:scale-105 mb-4" 
                     src="{{ $floorImage }}" alt="Floor Plan Image">
            @endforeach
        </div>
    </div>
</div>


</body>

</html>
