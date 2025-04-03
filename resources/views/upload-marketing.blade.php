<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Marketing Content</title>
    @vite(['resources/css/app.css'])
</head>
@include('includes.admin-header')

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8 ">
        <h1 class="text-xl font-bold text-left mb-6 text-gray-800">Upload Marketing Content</h1>

        @if(session('success'))
        <!-- Mobile View -->
        <div id="success-alert" class="alert flex md:hidden items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 
        w-[100%] left-1/2 transform -translate-x-1/2 relative m-0" role="alert">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z"
                    stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>

        <!-- Desktop View -->
        <div id="success-alert-desktop" class="alert hidden md:flex items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 
        max-w-lg fixed top-0 right-0 mt-24 mr-4" role="alert">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z"
                    stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        <div class="flex flex-col sm:flex-row items-center mb-8 gap-4">
            <!-- Left: Upload Form -->
            <div class="w-full sm:w-1/2 bg-white p-6 rounded-lg shadow h-full sm:h-[600px]">
                <form action="{{ route('store.marketing') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div>
                        <label for="caption" class="block mb-4 text-sm font-medium text-gray-700">Caption:</label>
                        <textarea name="caption" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="4"></textarea>
                    </div>

                    <div
                        class="border-2 border-dashed border-gray-300 bg-white rounded-lg p-6 flex flex-col items-center justify-center text-center">
                        <svg class="text-indigo-500 w-12 h-12 mb-3" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V12M12 16V8m5 8V4M4 20h16" />
                        </svg>
                        <p class="text-sm text-gray-600">Upload an image (PNG, JPG, JPEG, GIF) - Max: 15MB</p>

                        <label
                            class="mt-4 w-40 text-white py-2 px-4 rounded-lg shadow-md cursor-pointer bg-gradient-to-br from-indigo-600 to-purple-500 transition-all duration-300 hover:brightness-110">
                            <input type="file" name="image" id="fileInput" accept="image/*" hidden required />
                            Choose File
                        </label>

                        <!-- File Path Display -->
                        <p id="filePath" class="mt-2 text-sm font-medium text-blue-600"></p>

                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-[70%] m-auto flex items-center gap-2 px-6 py-2 text-white rounded-lg shadow-md bg-gradient-to-br from-indigo-600 to-purple-500 transition-all duration-300 transform hover:scale-105 hover:brightness-110">
                            <svg class="h-5 w-5 text-white transition-all" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            Upload
                        </button>

                    </div>
                </form>
            </div>

            <!-- Right: Uploaded Images -->

            <div class="w-full sm:w-[70%]">
                <!-- Scrollable List -->
                <div class="max-h-[600px] overflow-y-auto ">
                    <ul class="space-y-4">
                        @foreach($marketingContents as $content)
                        <li class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-4">
                            <!-- Image -->
                            <img src="{{ asset('storage/' . $content->image) }}"
                                class="w-16 h-16 object-cover rounded-lg">

                            <!-- Caption -->
                            <p class="text-gray-800 font-semibold flex-1">{{ Str::limit($content->caption, 50) }}</p>

                            <!-- Delete Button -->
                            <form action="{{ route('delete.marketing', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-2 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 text-sm">
                                    <svg class="h-5 w-5 text-white group-hover:text-gray-200 transition" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>

                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <script>
        // Select the input field and the element to show the file path
        const fileInput = document.getElementById('fileInput');
        const filePathDisplay = document.getElementById('filePath');

        // Add event listener for when a file is selected
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];

            if (file) {
                // Show the file path below the upload button in blue color
                filePathDisplay.textContent = `File selected: ${file.name}`;
            } else {
                filePathDisplay.textContent = ''; // Clear if no file is selected
            }
        });
        </script>


</body>

</html>