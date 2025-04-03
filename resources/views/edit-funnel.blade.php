<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Funnel Links</title>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8">
        <div class="mb-4">
            <a href="{{ route('funnel.main') }}"
                class="inline-flex items-center px-4 py-2 bg-gradient-to-br from-indigo-600 to-purple-500 text-white rounded-lg hover:bg-blue-600">
                <svg class="h-6 w-6 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <line x1="5" y1="12" x2="9" y2="16" />
                    <line x1="5" y1="12" x2="9" y2="8" />
                </svg>
                Go Back
            </a>
        </div>

        @if (session('success'))
    <div id="success-message" class="bg-green-100 text-green-700 border border-green-400 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); // 3 seconds
    </script>
@endif


        <h1 class="text-2xl font-semibold mb-4">Update Funnel Links</h1>

        <form action="{{ route('save-funnel') }}" method="POST">
            @csrf

            <div
                class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                <label for="facebook_link" class="block text-lg font-medium">Messenger Or Fb Link</label>
                <input type="url" name="facebook_link" id="facebook_link"
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg"
                    value="{{ old('facebook_link', $user->facebook_link) }}">
                @error('facebook_link')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>



            <div
                class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                <label for="join_fb_group" class="block text-lg font-medium">Your Inquiry Group Chat Link</label>
                <input type="url" name="join_fb_group" id="join_fb_group"
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg"
                    value="{{ old('join_fb_group', $user->join_fb_group) }}">
                @error('join_fb_group')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror


                <div class=" mt-4 flex items-center">
                    <label for="join_fb_group_toggle"
                        class="text-red-500 block text-[15px] sm:text-lg font-medium mr-4">Check To Show On Page |
                        Uncheck To Hide On Page</label>
                    <input type="hidden" name="group_toggle" value="0">
                    <input type="checkbox" name="group_toggle" id="group_toggle"
                        class="h-6 w-6 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-lg" value="1"
                        {{ old('group_toggle', $user->group_toggle) ? 'checked' : '' }}>

                </div>
            </div>



            <div
                class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                <label for="page_link" class="block text-lg font-medium">Your Referral Link</label>
                <input type="url" name="page_link" id="page_link"
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg"
                    value="{{ old('page_link', $user->page_link) }}">
                @error('page_link')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror


                <div class="mt-4 flex items-center">
                    <label for="page_toggle" class="text-red-500 block text-[15px] sm:text-lg font-medium mr-4">Check To
                        Show On Page | Uncheck To Hide
                        On Page</label>
                    <input type="hidden" name="page_toggle" value="0">
                    <input type="checkbox" name="page_toggle" id="page_toggle"
                        class="h-6 w-6 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-lg" value="1"
                        {{ old('page_toggle', $user->page_toggle) ? 'checked' : '' }}>
                </div>
            </div>

            <button type="submit"
                class="w-48 px-4 py-2 bg-blue-500 text-white rounded-lg flex items-center justify-center">
                <svg class="h-6 w-6 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                Update Links
            </button>

        </form>
    </div>

    <script>
    document.getElementById('page_toggle').addEventListener('change', function() {
        this.value = this.checked ? 1 : 0;
    });
    document.getElementById('group_toggle').addEventListener('change', function() {
        this.value = this.checked ? 1 : 0;
    });
    </script>
</body>

</html>