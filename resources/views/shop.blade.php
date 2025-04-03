<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <title>Shop</title>

    @vite(['resources/css/app.css'])

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
</head>

<body>
    <!-- Header with Cart Icon and Count -->
    <header
        class="bg-white shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] py-4 glow-effect">
        <div class="container mx-auto flex justify-between items-center px-4 sm:px-6">
            <!-- Shop Title -->
            <h1 class="text-2xl font-bold text-violet-500 hover:text-indigo-800 transition duration-300 cursor-pointer">Shop</h1>


            <!-- Cart Icon Button -->
            <button id="cart-icon"
                class="text-white p-4 rounded-full relative group hover:bg-indigo-100 transition duration-300">
                <!-- Updated SVG Cart Icon with Violet Color and Proper Size -->
                <svg class="h-10 w-10 text-violet-500 group-hover:text-violet-700 transition duration-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>

                <!-- Cart Count Notification -->
                <span id="cart-count"
                    class="absolute top-2 right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">0</span>
            </button>
        </div>
    </header>



    <!-- Products Section -->
    <div class="container mx-auto p-6 mt-[30px]">

        <!-- Display Brands -->
        @foreach($brands as $brand)
        <!-- Use $brands here instead of $brand -->
        <h1 class="text-3xl font-extrabold text-left mb-8 
   bg-gradient-to-r from-blue-500 to-purple-600 text-transparent bg-clip-text
   drop-shadow-lg tracking-wide uppercase relative inline-block">{{ $brand->brand_name }}</h1>
        @endforeach

        <div class="container mx-auto p-1">
            <div class="flex flex-col gap-[80px]">
                @foreach($products as $product)
                <div class="container flex flex-col md:flex-row w-full">
                    <!-- Product Image -->
                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                        <img src="{{ asset('storage/' . $product->image_path) }}"
                            class="w-full h-auto md:h-auto md:w-[350px] object-contain rounded-lg shadow-[0_3px_10px_rgb(0,0,0,0.2)]"
                            alt="{{ $product->name }}">
                    </div>

                    <!-- Product Details -->


                    <div class="  p-2  md:w-2/3 md:pl-6">
                        <div class="flex items-center pl-0">
                            <span class="text-left text-gray-600 mr-0">Rating:</span>
                            <div class="flex items-center ml-0">
                                <!-- Replace this with your rating component -->
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-gray-300">&#9733;</span>
                            </div>
                        </div>

                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        <p class="text-gray-700 mt-2">
                            {{ substr($product->description, 0, 200) }}{{ strlen($product->description) > 200 ? '...' : '' }}
                        </p>

                        <p class="text-lg font-bold mt-10">Product Price: &#8369;{{ number_format($product->price, 2) }}
                        </p>


                        <!-- Quantity Controls and Add to Cart Button -->
                        <div class="flex items-center gap-2 mt-2">
                            <!-- Inline controls group (Quantity + Add to Cart) -->
                            <div class="flex items-center ">
                                <!-- Quantity Buttons -->
                                <button
                                    class="quantity-btn decrease bg-white text-black p-2 rounded-l-lg border border-gray-300 hover:bg-gray-100 transition-colors"
                                    data-product-id="{{ $product->id }}">&minus;</button>

                                <input type="number" min="1" value="1" class="quantity-input p-2 border-t border-b border-gray-300 w-16 text-center 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                    data-product-id="{{ $product->id }}"
                                    data-shipping-rules='{{ json_encode($product->shipping_rules) }}'>


                                <button
                                    class="quantity-btn increase bg-white text-black p-2 rounded-r-lg border border-gray-300 hover:bg-gray-100 transition-colors"
                                    data-product-id="{{ $product->id }}">+</button>
                            </div>

                            <!-- Add to Cart Button -->
                            <button
                                class="add-to-cart w-full max-w-[200px] bg-gradient-to-br from-indigo-600 to-purple-500 text-white px-4 py-2 rounded flex items-center justify-center space-x-2"
                                data-product-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}" data-weight="{{ $product->weight }}">
                                <!-- Add data-weight attribute here -->
                                <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                </svg>
                                <span>Add to Cart</span>
                            </button>


                        </div>

                        <div class="flex items-center gap-4 mt-5">
                            <!-- Heart (Love) Reaction -->
                            <button id="love-button"
                                class="flex items-center gap-1 text-gray-600 hover:text-red-500 transition">
                                <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7" />
                                </svg>
                                <span class="text-sm">Love</span>
                            </button>
                            <span id="love-count" class="text-gray-600">360</span>
                            <!-- Displaying default Love count -->

                            <!-- Like Reaction -->
                            <button id="like-button"
                                class="flex items-center gap-1 text-gray-600 hover:text-blue-500 transition">
                                <svg class="h-6 w-6 text-blue-500" width="24" height="24" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
                                </svg>
                                <span class="text-sm">Like</span>
                            </button>
                            <span id="like-count" class="text-gray-600">570</span>
                            <!-- Displaying default Like count -->
                        </div>

                        <script>
                        // Get initial counts from localStorage or set defaults
                        let loveCount = localStorage.getItem('loveCount') ? parseInt(localStorage.getItem(
                            'loveCount')) : 360;
                        let likeCount = localStorage.getItem('likeCount') ? parseInt(localStorage.getItem(
                            'likeCount')) : 570;

                        // Display the initial counts
                        document.getElementById('love-count').textContent = loveCount;
                        document.getElementById('like-count').textContent = likeCount;

                        // Add event listener to the Love button
                        document.getElementById('love-button').addEventListener('click', function() {
                            loveCount++;
                            document.getElementById('love-count').textContent = loveCount;
                            localStorage.setItem('loveCount',
                                loveCount); // Save the updated count to localStorage
                        });

                        // Add event listener to the Like button
                        document.getElementById('like-button').addEventListener('click', function() {
                            likeCount++;
                            document.getElementById('like-count').textContent = likeCount;
                            localStorage.setItem('likeCount',
                                likeCount); // Save the updated count to localStorage
                        });
                        </script>



                    </div>

                </div>
                @endforeach
            </div>
        </div>



        <!-- Success Alert -->
        <div id="success-message"
            class="hidden fixed top-[9%] right-[10%] sm:top-[8%] sm:right-[12%] w-[80%] sm:max-w-[400px] shadow-lg rounded-lg flex">
            <!-- Left Colored Icon Box -->
            <div class="bg-green-500 py-3 px-4 sm:py-4 sm:px-6 rounded-l-lg flex items-center">
                <svg class="h-6 w-6 sm:h-8 sm:w-8 text-slate-100" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>

            <!-- Alert Message -->
            <div
                class="px-3 py-2 sm:px-4 sm:py-3 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                <span id="success-text"></span>
            </div>
        </div>



        <!-- Cart Sidebar -->
        <div id="cart-overlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" style="z-index: 999;"></div>

        <div id="cart-sidebar"
            class="fixed right-0 top-0 w-full h-full sm:w-[500px] bg-white shadow-lg transform translate-x-full transition-transform" style="z-index: 999;">
            <div class="p-4 relative">
                <h2 class="text-2xl font-bold text-purple-500">Cart</h2>
                <!-- Cart Sidebar Close Button with Custom SVG Icon -->
                <button id="close-cart" class="rounded-[2px] absolute top-4 right-7 text-red-500 text-xl shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                    <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                    </svg>
                </button>

                <ul id="cart-items" class="mt-4"></ul>
                <p class="mt-6 font-bold text-lg text-green-500">Grand Total: <span id="cart-total"
                        class="text-red-500">&#8369;0.00</span></p>

                <!-- Checkout Button -->
                <button class="w-full bg-gradient-to-br from-indigo-600 to-purple-500 text-white py-2 rounded-lg mt-4"
                    onclick="fetchCartAndRedirect()">Checkout</button>
            </div>
            
        </div>

        


        <script>
        // Load cart from sessionStorage if available
        let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

        document.addEventListener("DOMContentLoaded", function() {
            updateCart(); // Update cart UI on page load
        });

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.dataset.productId;
                let name = this.dataset.name;
                let price = parseFloat(this.dataset.price);
                let quantityInput = document.querySelector(
                    `.quantity-input[data-product-id='${productId}']`);
                let quantity = parseInt(quantityInput.value);
                let shippingRules = JSON.parse(quantityInput.dataset.shippingRules);
                let image = this.closest('.container').querySelector('img').src;
                let weight = parseFloat(this.dataset
                    .weight); // Get product weight dynamically from data attribute

                let shippingFee = calculateShipping(quantity, weight,
                    shippingRules); // Use dynamic weight here
                let totalPrice = price * quantity;

                let existingProduct = cart.find(item => item.id === productId);
                if (existingProduct) {
                    existingProduct.quantity += quantity;
                    existingProduct.shippingFee = calculateShipping(existingProduct.quantity,
                        weight, shippingRules);
                    existingProduct.totalPrice = existingProduct.price * existingProduct.quantity;
                } else {
                    cart.push({
                        id: productId,
                        name,
                        price,
                        quantity,
                        shippingFee,
                        totalPrice,
                        image,
                        weight
                    });
                }

                updateCart();
                showSuccessAlert(name); // Show alert after adding to cart
            });
        });

        function calculateShipping(quantity, weight, rules) {
            let totalWeight = quantity * weight; // Use the product's weight here
            for (let rule of rules) {
                if (totalWeight >= rule.min_weight && totalWeight <= rule.max_weight) {
                    return rule.shipping_fee;
                }
            }
            return rules.length > 0 ? rules[rules.length - 1].shipping_fee : 0; // Default to highest rule if none match
        }

        function updateCart() {
            let cartItems = document.getElementById('cart-items');
            let cartTotal = document.getElementById('cart-total');
            let cartCount = document.getElementById('cart-count');
            cartItems.innerHTML = '';
            let total = 0;
            let count = 0;

            cart.forEach((item, index) => {
                total += item.totalPrice + item.shippingFee;
                count += item.quantity;
                cartItems.innerHTML += `
        <li class='border-b p-4 flex'>
            <img src="${item.image}" class="w-[20%] h-[auto] object-cover rounded mr-4" alt="${item.name}">
            <div class="flex-grow">
                <p class="font-semibold mb-2">${item.name}</p>
                <p class="text-sm text-gray-700">Total Price: <span class="font-bold">&#8369;${item.totalPrice.toFixed(2)}</span></p>
                <p class="text-sm text-gray-700">Shipping Fee: <span class="font-bold">&#8369;${item.shippingFee.toFixed(2)}</span></p>
                <p class="text-sm text-gray-700">Quantity: <span class="font-bold">${item.quantity}</span></p>
            </div>
            <button class="delete-item text-red-500 text-lg ml-2" data-index="${index}">
                <i class="fas fa-trash"></i>
            </button>
        </li>`;
            });

            cartTotal.textContent = `₱${total.toFixed(2)}`;
            cartCount.textContent = count;

            // Save cart to sessionStorage
            sessionStorage.setItem('cart', JSON.stringify(cart));

            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-item').forEach(button => {
                button.addEventListener('click', function() {
                    let index = this.dataset.index;
                    cart.splice(index, 1);
                    updateCart();
                });
            });
        }

        function fetchCartAndRedirect() {
            // Get cart data from sessionStorage before redirecting
            const cartData = JSON.parse(sessionStorage.getItem('cart')) || [];

            // Optionally, log the cart data for debugging
            console.log(cartData);

            // Now, redirect to the checkout page
            window.location.href = '/checkout';
        }


        document.getElementById('cart-icon').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.remove('translate-x-full');
            document.getElementById('cart-overlay').classList.remove('hidden');
        });

        document.getElementById('close-cart').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.add('translate-x-full');
            document.getElementById('cart-overlay').classList.add('hidden');
        });

        document.getElementById('cart-overlay').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.add('translate-x-full');
            document.getElementById('cart-overlay').classList.add('hidden');
        });

        // Handling quantity change (increase and decrease buttons)
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.dataset.productId;
                let quantityInput = document.querySelector(
                    `.quantity-input[data-product-id='${productId}']`);
                let currentQuantity = parseInt(quantityInput.value);

                if (this.classList.contains('decrease')) {
                    if (currentQuantity > 1) {
                        quantityInput.value = currentQuantity - 1;
                        updateCartQuantity(productId, currentQuantity - 1);
                    }
                } else if (this.classList.contains('increase')) {
                    quantityInput.value = currentQuantity + 1;
                    updateCartQuantity(productId, currentQuantity + 1);
                }
            });
        });

        function updateCartQuantity(productId, newQuantity) {
            let product = cart.find(item => item.id === productId);
            if (product) {
                product.quantity = newQuantity;
                let shippingRules = JSON.parse(document.querySelector(`.quantity-input[data-product-id='${productId}']`)
                    .dataset.shippingRules);
                product.shippingFee = calculateShipping(newQuantity, shippingRules);
                product.totalPrice = product.price * newQuantity;
                updateCart();
            }
        }

        function showSuccessAlert(itemName) {
            const successMessage = document.getElementById('success-message');
            const successText = document.getElementById('success-text');

            // Set the success message text
            successText.innerText = `${itemName} added to cart!`;

            // Show the success message div
            successMessage.classList.remove('hidden');

            // Hide it after 5 seconds
            setTimeout(() => {
                successMessage.classList.add('hidden');
            }, 5000);
        }
        </script>
    </div> <!-- End of main content container -->

    <div class="slider"></div>

    <footer class="bg-[#f5faff] text-gray-800 py-4">
    <div class="w-full py-10">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-4">
            <!-- Copyright -->
            <p class="text-sm">© 2025 ShopName. All Rights Reserved.</p>

            <!-- Social Media Icons -->
            <div class="flex space-x-4">
                <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>
</div>


</body>
</html>
