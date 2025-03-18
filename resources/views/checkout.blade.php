<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50">

    <div class="container mx-auto p-6 space-y-8">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-900 text-left px-4 py-2">Checkout</h2>
        <a href="{{ route('shop') }}" class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-gray-100 transition fixed top-0 right-0 m-4">
    ← Back to Shop
</a>


        <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-8">
            <!-- Order Summary Section -->
            <div class="flex-1 bg-white p-8 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Order Summary</h3>
                <ul id="cart-items" class="space-y-6">
                    <!-- Cart items will be dynamically injected here -->
                </ul>

                <div class="mt-6 border-t pt-4">
                    <p class="text-lg font-bold text-gray-700">Grand Total: <span id="cart-total" class="text-red-500">₱0.00</span></p>
                </div>
            </div>

            <!-- Checkout Form Section -->
            <div class="flex-1 p-8 ">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Shipping Information</h3>
                <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="cart_data" id="cart-data">

                    <!-- Customer Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" required class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" required class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" required class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="address" required class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Barangay</label>
                            <input type="text" name="barangay" required class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code</label>
                            <input type="text" name="zip_code" required class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Payment Option -->
                    <div>
                        <label for="payment-option" class="block text-sm font-medium text-gray-700 mb-2">Choose Payment Option</label>
                        <select id="payment-option" name="payment_option" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required onchange="showPaymentDetails()">
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="gcash">Gcash</option>
                            <option value="bank-transfer">Bank Transfer</option>
                            <option value="qr-code">QR Code</option>
                        </select>
                    </div>

                    <!-- Payment Details -->
                    <div id="payment-details" class="mt-6 text-sm text-gray-700">
                        <!-- Dynamic payment details will appear here based on selected option -->
                    </div>

                    <!-- Attach Proof of Payment -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Attach Proof of Payment</h3>
                        <div class="flex flex-col items-center  mb-3 space-y-">
                            <div class="relative w-full">
                                <label class="flex justify-center w-full h-32 px-4 transition mb-2 bg-white border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 focus:outline-none" id="drop">
                                    <span class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <span class="font-medium text-gray-600">Drop files to Attach, or <span class="text-blue-600 underline">browse</span></span>
                                    </span>
                                    <input type="file" name="file_upload" class="hidden" accept="image/png,image/jpeg" id="input">
                                </label>
                                <div id="file-path" class="mt-4 text-gray-600 text-sm"></div>
                                <div id="image-preview" class="mt-4"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-br from-indigo-600 to-purple-500 text-white py-3 rounded-lg hover:bg-green-700 transition ease-in-out duration-200">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
    // Select the input field and the element to show the file path
    const fileInput = document.getElementById('input');
    const filePath = document.getElementById('file-path');

    // Add event listener for when a file is selected
    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];

        if (file) {
            // Show the file path in red color
            filePath.textContent = `File selected: ${file.name}`;
            filePath.style.color = 'blue';  // Set text color to red
        } else {
            filePath.textContent = ''; // Clear if no file is selected
        }
    });
</script>

    <script>
        // Function to show payment details based on selected payment method
        function showPaymentDetails() {
            const paymentOption = document.getElementById('payment-option').value;
            const paymentDetailsDiv = document.getElementById('payment-details');
            paymentDetailsDiv.style.border = '2px dashed #ccc';
            paymentDetailsDiv.style.padding = '16px';
            paymentDetailsDiv.style.borderRadius = '8px';

            if (paymentOption === 'gcash') {
                paymentDetailsDiv.innerHTML = `<p>Gcash Number: <span class="text-red-500">092776290</span></p>`;
            } else if (paymentOption === 'bank-transfer') {
                paymentDetailsDiv.innerHTML = `<p>Bank Transfer Account Number: <span class="text-red-500">0492749473949</span></p>`;
            } else if (paymentOption === 'qr-code') {
                paymentDetailsDiv.innerHTML = `<p>Scan this QR Code for payment:</p><img src="https://tse4.mm.bing.net/th?id=OIP.ifa8GFCtfbXfvZVh0HB7SAHaHa&pid=Api&P=0&h=220" alt="QR Code" class="mt-2 w-40 h-40 object-cover">`;
            } else {
                paymentDetailsDiv.innerHTML = '';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            let cartItemsContainer = document.getElementById('cart-items');
            let cartTotalElement = document.getElementById('cart-total');
            let cartDataInput = document.getElementById('cart-data');

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = "<p class='text-center text-gray-500'>Your cart is empty.</p>";
                return;
            }

            let total = 0;
            cartItemsContainer.innerHTML = '';

            cart.forEach(item => {
                let itemTotal = item.totalPrice + item.shippingFee;
                total += itemTotal;

                cartItemsContainer.innerHTML += `
                    <li class="flex items-center border-b pb-4">
                        <img src="${item.image}" class="w-20 sm:w-40 h-auto object-cover rounded mr-4" alt="${item.name}">
                        <div class="flex-grow">
                            <p class="mb-1 text-[20px] sm:mb-2 sm:text-[30px] font-semibold text-gray-800">${item.name}</p>
                            <p class="text-[15px] sm:text-xl text-gray-600">Price: <span class="font-bold">₱${item.price.toFixed(2)}</span></p>
                            <p class="text-[15px] sm:text-xl text-gray-600">Shipping Fee: <span class="font-bold">₱${item.shippingFee.toFixed(2)}</span></p>
                            <p class="text-[15px] sm:text-xl text-gray-600">Quantity: <span class="font-bold">${item.quantity}</span></p>
                        </div>
                    </li>
                `;
            });

            cartTotalElement.textContent = `₱${total.toFixed(2)}`;
            cartDataInput.value = JSON.stringify(cart);
       
            // Clear cart from session after form submission success
    sessionStorage.removeItem('cart');
});
    </script>

</body>
</html>
