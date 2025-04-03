<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Funnels</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">My Landing Pages & Sales Funnels</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($landingPages as $landingPage)
                <div class="bg-white shadow-lg rounded-lg p-5 border">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $landingPage->landing_title }}</h3>
                    <p class="text-sm text-gray-600">Page ID: <span class="font-mono">{{ $landingPage->page_id }}</span></p>
                    
                    <a href="{{ url('/' . $user->subdomain . '/' . $landingPage->page_id) }}" 
                        class="block mt-3 text-blue-600 font-medium hover:text-blue-800 transition">
                        View Landing Page →
                    </a>

                    @php
                        $funnelPage = $landingPage->funnelPage;
                    @endphp

                    @if($funnelPage)
                        <h4 class="mt-3 font-bold text-gray-700">Sales Funnel:</h4>
                        <p class="text-sm text-gray-600">{{ $funnelPage->funnel_title }}</p>
                        <a href="{{ url('/' . $user->subdomain . '/' . $funnelPage->page_id) }}" 
                            class="block text-blue-600 font-medium hover:text-blue-800 transition">
                            View Sales Funnel →
                        </a>
                    @else
                        <p class="text-sm text-gray-500 mt-3">No Sales Funnel linked.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
