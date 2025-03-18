<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    @vite(['resources/css/app.css'])
</head>

<body class=" bg-gray-100 flex justify-center items-center min-h-screen">

    @if(session('success'))
    <div id="success-alert"
        class="alert flex md:hidden items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 w-[90%] left-1/2 transform -translate-x-1/2 relative m-0"
        role="alert">
        <span>{{ session('success') }}</span>
    </div>
    <div id="success-alert-desktop"
        class="alert hidden md:flex items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 max-w-lg fixed top-0 right-0 mt-24 mr-4"
        role="alert">
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="dark:bg-gray-900 p-8 rounded-lg w-full max-w-7xl">
    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Upload Product</h2>

    <!-- Upload Form Section -->
    <div class="flex flex-col md:flex-row space-x-0 md:space-x-8">
        <!-- Brand Form -->
        <div class="w-full md:w-1/2">
            <form action="{{ route('brands.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] mb-8 w-full">
                @csrf
                <div class="mb-6">
                    <label for="brand_name" class="block text-sm font-medium text-gray-900 dark:text-white">Brand Name</label>
                    <input type="text" id="brand_name" name="brand_name" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-white">
                </div>
                <button type="submit"
                    class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-sm leading-tight uppercase rounded-lg shadow-md">
                    Submit Brand
                </button>
            </form>
        </div>

        <!-- Product Form -->
        <div class="w-full md:w-1/2">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-6">
                    <!-- Product Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5" required>
                    </div>

                    <!-- Price -->
                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5" required>
                    </div>

                    <!-- Product Weight -->
                    <div class="w-full">
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Weight (grams)</label>
                        <input type="number" step="0.01" id="weight" name="weight" value="{{ old('weight') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <!-- Product Description -->
                <div class="sm:col-span-2 mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5" required>{{ old('description') }}</textarea>
                </div>

                <!-- Product Category -->
                <div class="w-full mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category (optional)</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5">
                </div>

                <!-- Product Image -->
                <div class="w-full mb-6">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                <!-- Shipping Rules (JSON) -->
                <div class="sm:col-span-2 mb-6">
                    <label for="shipping_rules" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping Rules (JSON)</label>
                    <textarea id="shipping_rules" name="shipping_rules" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-white text-sm rounded-lg block w-full p-2.5" required>{{ old('shipping_rules') }}</textarea>
                </div>

                <!-- Button and Eye Icon for Viewing JSON -->
                   <!-- Button and Eye Icon for Viewing JSON -->
                   <button type="button" id="view-json-btn" 
                    class="text-red-600 mb-0 flex items-center space-x-2 px-4 py-0 rounded-md transition-all duration-300 ease-in-out">
                    <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span>View Shipping Rules JSON</span>
                </button>

                 <!-- Modal for Viewing JSON -->
                 <div id="json-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
                    <div class="bg-white p-6 rounded-lg max-w-lg w-[90%]">
                        <h2 class="text-lg font-semibold mb-4">Shipping Rules (JSON)</h2>
                        <div id="copy-success-message" class="p-4 text-green-600 hidden">
                            JSON copied to clipboard!
                        </div>
                        <pre id="json-content" class="bg-gray-100 p-4 rounded-lg text-sm overflow-auto max-h-96"></pre>
                        <button type="button" id="copy-json-btn" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg">Copy</button>
                        <button type="button" id="close-json-modal" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg">Close</button>
                    </div>
                </div>

                <!-- Submit and Reset Buttons -->
                <div class="flex items-center space-x-4 mt-6">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Upload Product
                    </button>
                    <button type="reset" class="text-red-600 border border-red-600 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Clear
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>


        <!-- Add your scripts here -->
        <script>
        // Example JSON content
        const jsonData = [{
                "min_weight": 0,
                "max_weight": 500,
                "pouch_type": "Small",
                "shipping_fee": 120
            },
            {
                "min_weight": 501,
                "max_weight": 1000,
                "pouch_type": "Small",
                "shipping_fee": 120
            },
            {
                "min_weight": 1001,
                "max_weight": 2000,
                "pouch_type": "Medium",
                "shipping_fee": 180
            },
            {
                "min_weight": 2001,
                "max_weight": 3000,
                "pouch_type": "Medium",
                "shipping_fee": 180
            },
            {
                "min_weight": 3001,
                "max_weight": 4000,
                "pouch_type": "Large",
                "shipping_fee": 300
            },
            {
                "min_weight": 4001,
                "max_weight": 5000,
                "pouch_type": "Large",
                "shipping_fee": 300
            },
            {
                "min_weight": 5001,
                "max_weight": 6000,
                "pouch_type": "Extra Large",
                "shipping_fee": 400
            }
        ];

        // Open the modal
        document.getElementById('view-json-btn').addEventListener('click', function() {
            // Format the JSON and display it inside the modal
            document.getElementById('json-content').textContent = JSON.stringify(jsonData, null,
            4); // Pretty print with indentation
            document.getElementById('json-modal').classList.remove('hidden');
        });

        // Close the modal
        document.getElementById('close-json-modal').addEventListener('click', function() {
            document.getElementById('json-modal').classList.add('hidden');
        });

        // Copy JSON to clipboard
        document.getElementById('copy-json-btn').addEventListener('click', function() {
            const jsonContent = document.getElementById('json-content').textContent;
            navigator.clipboard.writeText(jsonContent).then(function() {
                // Show success message below the textarea
                const successMessage = document.getElementById('copy-success-message');
                successMessage.classList.remove('hidden');
                setTimeout(function() {
                    successMessage.classList.add('hidden');
                }, 2000); // Hide the success message after 2 seconds
            }).catch(function(error) {
                console.error('Error copying JSON: ', error);
            });
        });
        </script>

</body>

</html>