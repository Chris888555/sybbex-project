<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
    <title>Checkout</title>
</head>

<body class="bg-white-100 mb-[50px]">

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success text-green-600 bg-green-100 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error text-red-600 bg-red-100 p-4 rounded-lg mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="container mx-auto mt-8 p-6  rounded-lg  max-w-6xl">

        <h2 class="text-2xl font-semibold mb-6 text-left text-gray-800">Checkout Summary</h2>

        <div
            class="mb-20 mt-7 shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">

        </div>


        <div class="flex flex-col sm:flex-row gap-10">
            <!-- Cart Items Section -->
            <div class="w-[90%]">
                <div id="cart-items">
                    <!-- Cart items will be injected here via JS -->
                </div>

                <div id="grand-total" class="text-xl font-bold text-red-500 mt-9">
                    <!-- Grand total will be displayed here -->
                </div>
            </div>

            <!-- Shipping Information Form Section -->
            <div class="w-full m-auto border-t border-gray-300 pt-10 sm:border-none sm:pt-0">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Shipping Information</h3>

                <form id="shipping-form" action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Hidden cart data field -->
                    <input type="hidden" id="cart-data" name="cart_data" value="">


                    <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6 ">
                        <!-- First Name -->
                        <div>
                            <label for="first-name" class="block text-sm text-gray-700">First Name</label>
                            <input type="text" id="first-name" class="w-full p-3 border border-gray-300 rounded-lg"
                                required>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last-name" class="block text-sm text-gray-700">Last Name</label>
                            <input type="text" id="last-name" class="w-full p-3 border border-gray-300 rounded-lg"
                                required>
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm text-gray-700">Phone Number</label>
                        <input type="text" id="phone" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm text-gray-700">Shipping Address</label>
                        <input type="text" id="address" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Barangay -->
                    <div>
                        <label for="barangay" class="block text-sm text-gray-700">Barangay</label>
                        <input type="text" id="barangay" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Zip Code -->
                    <div>
                        <label for="zip-code" class="block text-sm text-gray-700">Zip Code</label>
                        <input type="text" id="zip-code" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Payment Option -->
                    <div>
                        <label for="payment-option" class="block text-sm text-gray-700">Choose Payment Option</label>
                        <select id="payment-option" class="w-full p-3 border border-gray-300 rounded-lg" required
                            onchange="showPaymentDetails()">
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

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Attach Proof Of Payment</h3>
                        <div class="flex-1 items-center max-w-screen-sm mx-auto mb-3 space-y-4 sm:flex sm:space-y-0">
                            <div class="relative w-full">
                                <div class="items-center justify-center max-w-xl mx-auto">
                                    <label
                                        class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                                        id="drop">
                                        <span class="flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <span class="font-medium text-gray-600">Drop files to Attach, or
                                                <span class="text-blue-600 underline ml-[4px]">browse</span>
                                            </span>
                                        </span>
                                        <input type="file" name="file_upload" class="hidden"
                                            accept="image/png,image/jpeg" id="input">
                                    </label>
                                    <div id="file-path" class="mt-4 text-gray-600 text-sm"></div>
                                    <div id="image-preview" class="mt-4">
                                        <!-- Image preview will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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


                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                            Confirm Order
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- File Upload Section -->


    </div>
    <script>
    // Function to display cart items and calculate grand total
    function displayCartItems() {
        const cartData = JSON.parse(sessionStorage.getItem('cart')) || []; // Change this to sessionStorage

        // Create a map to track quantities for duplicate items
        const cartMap = {};

        cartData.forEach(item => {
            const key = item.id; // assuming each item has a unique 'id'
            if (cartMap[key]) {
                cartMap[key].quantity += item.quantity; // Update quantity if item already exists
            } else {
                cartMap[key] = {
                    ...item
                }; // Add new item
            }
        });

        const uniqueCartData = Object.values(cartMap); // Get all unique items

        let totalPrice = 0;

        if (uniqueCartData.length > 0) {
            let cartHtml = '<div class="space-y-6">';

            uniqueCartData.forEach(item => {
                const itemTotal = (item.price * item.quantity + item.shipping_fee * item.quantity).toFixed(2);
                totalPrice += parseFloat(itemTotal);

                cartHtml += `
                        <div class="flex items-center justify-between border-b py-4">
                            <div class="flex items-center space-x-4">
                                <img src="/storage/${item.image}" alt="${item.name}" class="w-32 h-32 object-contain rounded-lg shadow-md">
                                <div>
                                    <p class="text-lg font-semibold text-gray-800">${item.name}</p>
                                    <p class="text-sm text-gray-600">Price: ₱${item.price}</p>
                                    <p class="text-sm text-gray-600">Shipping Fee: ₱${item.shipping_fee}</p>
                                    <p class="text-sm text-gray-600">Quantity: ${item.quantity}</p>
                                </div>
                            </div>
                        </div>`;
            });

            cartHtml += '</div>';
            document.getElementById('cart-items').innerHTML = cartHtml;
        } else {
            document.getElementById('cart-items').innerHTML =
                '<p class="text-center text-gray-600">Your cart is empty.</p>';
        }

        // Display Grand Total
        const grandTotal = totalPrice.toFixed(2);
        document.getElementById('grand-total').innerHTML = `Grand Total: ₱${grandTotal}`;
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

    // Display the cart items and Grand Total when the page loads
    displayCartItems();

   
    // When the form is submitted, send the cart data to the backend
document.getElementById('shipping-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission to handle the cart data first

    // Fetch the cart data from sessionStorage
    const cartData = JSON.parse(sessionStorage.getItem('cart')) || [];

    // Log the cart data before sending it to the backend
    console.log('Cart Data to Submit:', cartData); // Check the cart data in the console

    // Set the cart data in the hidden input field
    document.getElementById('cart-data').value = JSON.stringify(cartData);

    // After setting the cart data, submit the form
    this.submit(); // Now submit the form after the data is set
});

</script>

</body>

</html>