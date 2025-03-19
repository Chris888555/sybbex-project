<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">

    @vite(['resources/css/app.css'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</head>
@include('includes.admin-header')

<body class="bg-gray-100">
    <div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8">
   
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>

        <!-- Show Success/Error Message -->
        @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <!-- List of Products with toggle functionality -->
        <div class="mb-4">

            <ul>
                @foreach($products as $product)
                <!-- Product Item -->
                <li class="bg-white p-4 rounded-lg shadow-md mb-4 cursor-pointer" x-data="{ open: false }">
                    <!-- Clickable Header -->
                    <div class="flex justify-between items-center" @click="open = !open">
                        <p class="text-lg font-semibold">{{ $product->name }}</p>
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2">

                                <svg x-show="!open" class="w-7 h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-width="2" d="M5 8l5 5 5-5"></path>
                                </svg>
                                <svg x-show="open" class="w-7 h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-width="2" d="M5 12l5-5 5 5"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Toggle indicator -->
                    </div>


                    <!-- Edit Form -->
                    <div x-show="open" x-transition class="mt-4">
                        <form action="{{ route('product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category
                                    (optional)</label>
                                <input type="text" id="category" name="category"
                                    value="{{ old('category', $product->category) }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                            </div>

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                                    required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Product
                                    Description</label>
                                <textarea id="description" name="description" rows="4" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                                    required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg"
                                    step="0.01">
                            </div>



                            <div class="mb-4">
                                <label for="weight" class="block text-sm font-medium text-gray-700">Weight
                                    (grams)</label>
                                <input type="number" id="weight" name="weight"
                                    value="{{ old('weight', $product->weight) }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                            </div>

                            <div class="mb-4">
                                <label for="shipping_rules" class="block text-sm font-medium text-gray-700">Shipping
                                    Rules (JSON)</label>
                                <textarea id="shipping_rules" name="shipping_rules" rows="8" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">{{ old('shipping_rules', json_encode($product->shipping_rules, JSON_PRETTY_PRINT)) }}</textarea>

                                <p class="text-sm text-gray-500 mt-1">Example:
                                    [{"min_weight":0,"max_weight":500,"shipping_fee":120}]</p>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                                <input type="file" id="image" name="image" accept="image/*"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                                <img src="{{ asset('storage/'.$product->image_path) }}" alt="Product Image"
                                    class="mt-2 w-32 h-32 object-cover">
                            </div>

                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update
                                Product</button>

                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>

</html>