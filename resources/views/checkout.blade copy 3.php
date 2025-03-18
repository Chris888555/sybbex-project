<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</head>

<body class="bg-gray-100" x-data="checkoutStore()" x-init="init()">

    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-600 shadow-md py-4 glow-effect">
    <div class="container mx-auto flex justify-between items-center px-6">
        <h1 class="text-2xl font-bold text-white">Checkout</h1>
        <a href="{{ route('shop') }}" class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-gray-100 transition">
            ← Back to Shop
        </a>
    </div>
</header>


    <div class="container mx-auto p-6 flex flex-col lg:flex-row gap-6">
        <!-- Order Summary -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:w-1/2">
            <h2 class="text-2xl font-semibold mb-6">Order Summary</h2>
            <template x-if="cart.length > 0">
                <div>
                    <div class="space-y-4">
                        <template x-for="(item, index) in cart" :key="index">
                            <div class="flex justify-between items-center border-b py-4">
                                <div class="flex items-center space-x-4">
                                    <img :src="'/storage/' + item.image" class="w-[80px] h-[80px] object-contain">
                                    <div>
                                        <p class="font-semibold" x-text="item.name"></p>
                                        <p class="text-sm text-gray-600">Price: ₱<span x-text="item.price"></span></p>
                                        <p class="text-sm text-gray-600">Shipping Fee: ₱<span
                                                x-text="item.shipping_fee"></span></p>
                                        <p class="text-sm text-gray-600">Qty: <span x-text="item.quantity"></span></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-6 flex gap-4 font-semibold text-lg">
                        <p>Grand Total: </p>
                        <span class="text-red-500" x-text="'₱' + totalPrice()"></span>
                    </div>
                </div>
            </template>
            <template x-if="cart.length === 0">
                <p class="text-center text-gray-500">Your cart is empty!</p>
            </template>
        </div>

        <!-- Form to submit cart data -->
        <form action="{{ route('checkout.store') }}" method="POST" class="lg:w-1/2 space-y-6" @submit="submitForm"
            enctype="multipart/form-data">
            @csrf
            <!-- Hidden inputs for the cart data -->
            <input type="hidden" name="cart_data" :value="JSON.stringify(cart)">

            <!-- First Name -->
            <div>
                <label for="first-name" class="block text-sm text-gray-700">First Name</label>
                <input type="text" id="first-name" name="first_name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            <!-- Last Name -->
            <div>
                <label for="last-name" class="block text-sm text-gray-700">Last Name</label>
                <input type="text" id="last-name" name="last_name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-sm text-gray-700">Phone Number</label>
                <input type="text" id="phone" name="phone" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm text-gray-700">Shipping Address</label>
                <input type="text" id="address" name="address" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            <!-- Barangay -->
            <div>
                <label for="barangay" class="block text-sm text-gray-700">Barangay</label>
                <input type="text" id="barangay" name="barangay" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            <!-- Zip Code -->
            <div>
                <label for="zip-code" class="block text-sm text-gray-700">Zip Code</label>
                <input type="text" id="zip-code" name="zip_code" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            <!-- Payment Option -->
            <div>
                <label for="payment-option" class="block text-sm text-gray-700">Choose Payment Option</label>
                <select id="payment-option" name="payment_option" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required onchange="showPaymentDetails()">
                    <option value="" disabled selected>Select Payment Method</option>
                    <option value="gcash">Gcash</option>
                    <option value="bank-transfer">Bank Transfer</option>
                    <option value="qr-code">QR Code</option>
                </select>
            </div>

            <!-- Payment Details -->
            <div id="payment-details" class="mt-4 text-sm text-gray-700">
                <!-- Dynamic payment details will appear here based on selected option -->
            </div>

            <!-- Attach Proof of Payment -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Attach Proof Of Payment</h3>
                <div class="flex-1 items-center max-w-screen-sm mx-auto mb-3 space-y-4 sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <div class="items-center justify-center max-w-xl mx-auto">
                            <label
                                class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                                id="drop">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-gray-600">Drop files to Attach, or
                                        <span class="text-blue-600 underline ml-[4px]">browse</span>
                                    </span>
                                </span>
                                <input type="file" name="file_upload" class="hidden" accept="image/png,image/jpeg"
                                    id="input">
                            </label>
                            <div id="file-path" class="mt-4 text-gray-600 text-sm"></div>
                            <div id="image-preview" class="mt-4">
                                <!-- Image preview will appear here -->
                                <script>
                    // Get the file input element and the display elements
                    const fileInput = document.getElementById('input');
                    const filePathDiv = document.getElementById('file-path');
                    const imagePreviewDiv = document.getElementById('image-preview');

                    // Add an event listener to the file input to detect changes
                    fileInput.addEventListener('change', function() {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            // Display the file name (path or name only)
                            filePathDiv.textContent = `Selected file: ${file.name}`;

                            // Show the image preview
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                imagePreviewDiv.innerHTML =
                                    `<img src="${e.target.result}" alt="Selected Image" class="w-32 h-32 object-contain border rounded-md shadow-md">`;
                            };
                            reader.readAsDataURL(file); // This will generate a preview of the image
                        } else {
                            filePathDiv.textContent = ''; // Clear the file path if no file is selected
                            imagePreviewDiv.innerHTML = ''; // Clear the image preview if no file is selected
                        }
                    });
                    </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700">
                    Submit Order
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine.js Script -->
    <script>
    function checkoutStore() {
        return {
            cart: [],

            init() {
                this.loadCart(); // Load cart data from sessionStorage
            },

            loadCart() {
                let storedCart = sessionStorage.getItem('cart');
                if (storedCart) {
                    this.cart = JSON.parse(storedCart);
                }
            },

            totalPrice() {
                return this.cart.reduce((sum, item) => sum + ((item.price + item.shipping_fee) * item.quantity), 0)
                    .toFixed(2); // Calculate total price including shipping fee and quantity
            },

            submitForm(event) {
                // Ensure cart data is in the hidden input before submitting
                let cartDataInput = document.querySelector('input[name="cart_data"]');
                cartDataInput.value = JSON.stringify(this.cart);

                // Manually submit the form after adding cart data
                event.target.submit(); // Trigger form submission

                // Clear cart from sessionStorage after submission
                sessionStorage.removeItem('cart');
            }
        };
    }

    // Function to show payment details based on selected payment method
    function showPaymentDetails() {
        const paymentOption = document.getElementById('payment-option').value;
        const paymentDetailsDiv = document.getElementById('payment-details');

        // Add border and padding styles to the payment details div
        paymentDetailsDiv.style.border = '2px dashed #ccc'; // Dashed border
        paymentDetailsDiv.style.padding = '16px'; // Padding inside the div
        paymentDetailsDiv.style.borderRadius = '8px'; // Rounded corners for the border

        if (paymentOption === 'gcash') {
            paymentDetailsDiv.innerHTML = `<p>Gcash Number: <span style="color: red;">092776290</span></p>`;
        } else if (paymentOption === 'bank-transfer') {
            paymentDetailsDiv.innerHTML =
                `<p>Bank Transfer Account Number: <span style="color: red;">0492749473949</span></p>`;
        } else if (paymentOption === 'qr-code') {
            paymentDetailsDiv.innerHTML =
                `<p>Scan this QR Code for payment:</p><img src="https://tse4.mm.bing.net/th?id=OIP.ifa8GFCtfbXfvZVh0HB7SAHaHa&pid=Api&P=0&h=220" alt="QR Code" class="mt-2 w-40 h-40 object-cover">`;
        } else {
            paymentDetailsDiv.innerHTML = '';
        }
    }
    </script>

</body>

</html>
