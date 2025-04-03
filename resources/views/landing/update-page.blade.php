<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Landing & Sales Funnel Pages</title>

    <!-- Tailwind CSS via Vite -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    @vite(['resources/css/app.css'])
</head>
@include('includes.nav')
<body>

    <div class="container mx-auto py-6 px-4 mt-10">
        <h1 class="text-2xl font-bold mb-4">Update Landing Page & Sales Funnel Page</h1>

       

  <!-- Success Message -->
@if(session('success'))
    <div id="success-message" class="flex w-full overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
        <div class="flex items-center justify-center w-12 bg-emerald-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
            </div>
        </div>
    </div>

    <script>
        // Hide the success message after 3 seconds
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000);
    </script>
@endif



        <!-- Loop through each landing page -->
        @foreach($landingPages as $landingPage)
        @php
        $landingContent = json_decode($landingPage->landing_content, true);
        $salesFunnel = $landingPage->salesFunnelPages->first();
        $funnelContent = json_decode($salesFunnel->funnel_content ?? '{}', true);
        @endphp

        <!-- Alpine.js dropdown for each landing page -->
        <div class="bg-white p-6 mb-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] cursor-pointer"
            x-data="{ open: false }">
            <!-- Landing Page Title (Clickable) -->
            <h2 @click="open = !open" class="  cursor-pointer text-xl font-semibold cursor-pointer">
                {{ $landingPage->landing_title }} & {{ $salesFunnel->funnel_title }}
            </h2>

            <!-- Landing Page Update Form (Visible when clicked) -->
            <div x-show="open" x-transition class="mb-6">
                <form action="{{ route('landing.update-landing-page', $landingPage->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4 mt-6 p-6 rounded-lg shadow-[inset_-12px_-8px_40px_#46464620]">
                        <div class="mb-4 mt-6">
                            <label for="page_id" class="block text-sm font-medium text-gray-700">Lang Page Link</label>
                            <input type="text" name="page_id" value="{{ old('page_id', $landingPage->page_id) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Enter Page ID">
                        </div>

                        <div class="mb-4  ">
                            <label for="landing_title" class="block text-sm font-medium text-gray-700">Landing
                                Title</label>
                            <input type="text" name="landing_title"
                                value="{{ old('landing_title', $landingPage->landing_title) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Enter Landing Title">
                        </div>

                        <div class="mb-4">
                            <label for="headline" class="block text-sm font-medium text-gray-700">Landing
                                Headline</label>
                            <input type="text" name="headline"
                                value="{{ old('headline', $landingContent['headline'] ?? '') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Enter Headline">
                        </div>

                        <div class="mb-4">
                            <label for="subheadline" class="block text-sm font-medium text-gray-700">Landing
                                Subheadline</label>
                            <input type="text" name="subheadline"
                                value="{{ old('subheadline', $landingContent['subheadline'] ?? '') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Enter Subheadline">
                        </div>


                        <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div>
                            <button type="submit"
                                class="w-full sm:max-w-xs px-6 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md">Update Landing
                                Page</button>
                        </div>
                </form>

                <!-- Delete Landing Page Button -->
                <form action="{{ route('landing.delete', $landingPage->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full sm:max-w-xs px-6 py-2 text-white bg-red-500 hover:bg-red-600 rounded-md">
                            Delete Landing & Funnel
                        </button>
                    </form>
            </div>
        </div>
        </div>


        <!-- Sales Funnel Page Update Form (Visible when clicked) -->

        <div x-show="open" x-transition>
            <form action="{{ route('sales-funnel.update', $salesFunnel->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4 mt-6 p-6 rounded-lg shadow-[inset_-12px_-8px_40px_#46464620]">
                    <div class="mb-4">
                        <label for="page_id" class="block text-sm font-medium text-gray-700">Funnel Page Link</label>
                        <input type="text" name="page_id" value="{{ old('page_id', $salesFunnel->page_id) }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter Page ID">
                    </div>

                    <div class="mb-4">
                        <label for="funnel_title" class="block text-sm font-medium text-gray-700">Funnel Title</label>
                        <input type="text" name="funnel_title"
                            value="{{ old('funnel_title', $salesFunnel->funnel_title) }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter Funnel Title">
                    </div>

                    <div class="mb-4">
                        <label for="funnel_headline" class="block text-sm font-medium text-gray-700">Funnel
                            Headline</label>
                        <input type="text" name="funnel_headline"
                            value="{{ old('funnel_headline', $funnelContent['headline'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter Funnel Headline">
                    </div>

                    <div class="mb-4">
                        <label for="funnel_subheadline" class="block text-sm font-medium text-gray-700">Funnel
                            Subheadline</label>
                        <input type="text" name="funnel_subheadline"
                            value="{{ old('funnel_subheadline', $funnelContent['subheadline'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter Funnel Subheadline">
                    </div>

                    <div class="mb-4">
                        <label for="video_link" class="block text-sm font-medium text-gray-700">Video Link</label>
                        <input type="url" name="video_link"
                            value="{{ old('video_link', $funnelContent['video_link'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter Video Link">
                    </div>

                    <div class="mb-4">
                        <label for="chat_group_link" class="block text-sm font-medium text-gray-700">Chat Group
                            Link</label>
                        <input type="url" name="chat_group_link"
                            value="{{ old('chat_group_link', $funnelContent['chat_group_link'] ?? '') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter Chat Group Link">
                    </div>

                    <!-- Property Image Preview -->
                    <div class="mb-4">
                        <label for="property_image" class="block text-sm font-medium text-gray-700">Property
                            Image</label>
                        <input type="file" name="property_image"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        @if(isset($funnelContent['property_image']))
                        <p class="mt-4 text-gray-700 font-semibold">This is your old upload image</p>
                        <div class="mt-2">
                            <img class="w-16 h-16 rounded-lg shadow-md" src="{{ $funnelContent['property_image'] }}"
                                alt="Property Image">
                        </div>
                        @endif
                    </div>

                    <!-- Floor Plan Images Preview -->
                    <div class="mb-4">
                        <label for="floor_images" class="block text-sm font-medium text-gray-700">Gallery Images</label>
                        <input type="file" name="floor_images[]" multiple
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        @if(!empty($funnelContent['floor_images']))
                        <p class="mt-4 text-gray-700 font-semibold">This is your old upload images</p>
                        <div class="mt-4 flex flex-wrap gap-2 sm:flex-row">
                            @foreach ($funnelContent['floor_images'] as $floorImage)
                            <img class="w-16 h-16 rounded-lg shadow-md" src="{{ $floorImage }}" alt="Floor Plan Image">
                            @endforeach
                        </div>

                        @endif
                    </div>



                    <div>
                        <button type="submit"
                            class="px-6 py-2 text-white bg-green-500 hover:bg-green-600 rounded-md">Update Sales
                            Funnel</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
    @endforeach
    </div>


</body>

</html>