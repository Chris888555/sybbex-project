<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Checkout</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
            <ul id="cart-items" class="space-y-4"></ul>
            <div class="mt-6 border-t pt-4">
                <p class="text-lg font-bold text-gray-700">Grand Total: <span id="cart-total" class="text-red-500">₱0.00</span></p>
            </div>
            
            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" onsubmit="submitForm(event)">
                @csrf
                <input type="hidden" name="cart_data" id="cart-data">
                
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium">First Name</label>
                        <input type="text" name="first_name" required class="w-full p-2 border rounded"></div>
                    <div><label class="block text-sm font-medium">Last Name</label>
                        <input type="text" name="last_name" required class="w-full p-2 border rounded"></div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium">Phone</label>
                    <input type="text" name="phone" required class="w-full p-2 border rounded">
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium">Address</label>
                    <input type="text" name="address" required class="w-full p-2 border rounded">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div><label class="block text-sm font-medium">Barangay</label>
                        <input type="text" name="barangay" required class="w-full p-2 border rounded"></div>
                    <div><label class="block text-sm font-medium">Zip Code</label>
                        <input type="text" name="zip_code" required class="w-full p-2 border rounded"></div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium">Payment Option</label>
                    <select name="payment_option" required class="w-full p-2 border rounded" id="payment-option" onchange="showPaymentDetails()">
                        <option value="" disabled selected>Select Payment Method</option>
                        <option value="gcash">Gcash</option>
                        <option value="bank-transfer">Bank Transfer</option>
                        <option value="qr-code">QR Code</option>
                    </select>
                </div>
                <div id="payment-details" class="mt-4 text-sm text-gray-700"></div>
                
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Attach Proof Of Payment</h3>
                    <input type="file" name="file_upload" accept="image/png,image/jpeg" class="w-full p-2 border rounded">
                </div>
                
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg mt-4">Place Order</button>
            </form>
        </div>
    </div>
    
    <script>
        function submitForm(event) {
            let cartDataInput = document.getElementById('cart-data');
            cartDataInput.value = JSON.stringify(JSON.parse(sessionStorage.getItem('cart')) || []);
            sessionStorage.removeItem('cart');
        }

        function showPaymentDetails() {
            const paymentOption = document.getElementById('payment-option').value;
            const paymentDetailsDiv = document.getElementById('payment-details');
            paymentDetailsDiv.style.border = '2px dashed #ccc';
            paymentDetailsDiv.style.padding = '16px';
            paymentDetailsDiv.style.borderRadius = '8px';
            
            let details = {
                'gcash': '<p>Gcash Number: <span style="color: red;">092776290</span></p>',
                'bank-transfer': '<p>Bank Transfer Account Number: <span style="color: red;">0492749473949</span></p>',
                'qr-code': '<p>Scan this QR Code for payment:</p><img src="https://tse4.mm.bing.net/th?id=OIP.ifa8GFCtfbXfvZVh0HB7SAHaHa&pid=Api&P=0&h=220" alt="QR Code" class="mt-2 w-40 h-40 object-cover">'
            };
            paymentDetailsDiv.innerHTML = details[paymentOption] || '';
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
                let shippingFee = item.shippingFee ?? 0;
                let itemTotal = item.price * item.quantity + shippingFee;
                total += itemTotal;
                cartItemsContainer.innerHTML += `
                    <li class="flex items-center border-b pb-4">
                        <img src="${item.image}" class="w-16 h-16 object-cover rounded mr-4" alt="${item.name}">
                        <div class="flex-grow">
                            <p class="font-semibold">${item.name}</p>
                            <p class="text-sm text-gray-600">Price: <span class="font-bold">₱${item.price.toFixed(2)}</span></p>
                            <p class="text-sm text-gray-600">Shipping Fee: <span class="font-bold">₱${shippingFee.toFixed(2)}</span></p>
                            <p class="text-sm text-gray-600">Quantity: <span class="font-bold">${item.quantity}</span></p>
                        </div>
                    </li>`;
            });
            
            cartTotalElement.textContent = `₱${total.toFixed(2)}`;
            cartDataInput.value = JSON.stringify(cart);
        });
    </script>
</body>
</html>
