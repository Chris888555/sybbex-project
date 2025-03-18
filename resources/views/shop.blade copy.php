<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    @vite(['resources/css/app.css'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <style>
    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 40;
    }
    </style>
</head>

<body class="bg-gray-100" x-data="cartStore()">

    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-600 shadow-md py-4 glow-effect">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold text-white">Shop</h1>
            <div class="relative">
                <a href="#" class="text-gray-700 text-lg" @click.prevent="toggleCart()">
                    <svg class="h-8 w-8 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                    </svg>
                    <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1 absolute -top-1 -right-4"
                        x-text="cart.length"></span>
                </a>
            </div>
        </div>
    </header>

    <style>
    .glow-effect {
        text-shadow: 0 0 5px rgba(238, 130, 238, 0.5), 0 0 10px rgba(238, 130, 238, 0.4);
    }
    </style>



    <!-- Sidebar & Overlay -->
    <div x-show="isCartOpen" class="overlay" @click="closeCart()"></div>

    <div x-show="isCartOpen"
        class="fixed right-0 top-0 h-full w-full md:w-[500px] bg-white shadow-lg p-6 overflow-y-auto z-50 transform transition-transform duration-300 ease-in-out"
        x-bind:class="isCartOpen ? 'translate-x-0' : 'translate-x-full'">

        <!-- Close Button -->
        <button class="absolute top-2 right-2" @click="closeCart()">
            <svg class="h-8 w-8 text-gray-600 hover:text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                <line x1="18" y1="9" x2="12" y2="15" />
                <line x1="12" y1="9" x2="18" y2="15" />
            </svg>
        </button>


        <h2 class="text-lg font-bold mb-4">Cart Overview</h2>
        <template x-for="(item, index) in cart" :key="index">
            <div class="flex justify-between items-center border-b py-2">
                <div class="flex items-center space-x-4">
                    <img :src="'/storage/' + item.image" class="w-[100px] h-[100px] object-contain">
                    <div>
                        <p class="font-semibold mb-3" x-text="item.name"></p>
                        <p class="text-sm text-gray-600">Price: ₱<span x-text="item.price"></span></p>
                        <p class="text-sm text-gray-600">Shipping Fee: ₱<span x-text="item.shipping_fee"></span></p>
                        <p class="text-sm text-gray-600 mb-3">Qty: <span x-text="item.quantity"></span></p>

                    </div>
                </div>
                <button @click="removeFromCart(index)">
                    <svg class="h-6 w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

            </div>
        </template>
        <div class="mt-4">
    <p class="font-semibold text-center">Grand Total: ₱<span x-text="totalPrice()"></span></p>
    <button class="w-full bg-blue-600 text-white py-2 rounded-lg mt-4" @click="fetchCartAndRedirect()">Checkout</button>

<script>
    function fetchCartAndRedirect() {
        // Get cart data from localStorage before redirecting
        const cartData = JSON.parse(localStorage.getItem('cart')) || [];

        // Optionally, log the cart data for debugging
        console.log(cartData);

        // Now, redirect to the checkout page
        window.location.href = '/checkout';
    }
</script>

</div>

    </div>

    <!-- Products Section -->
    <div class="container mx-auto p-6">

        <!-- Display Brands -->
        @foreach($brands as $brand)
        <!-- Use $brands here instead of $brand -->
        <h1 class="text-3xl font-extrabold text-left mb-8 
           bg-gradient-to-r from-blue-500 to-purple-600 text-transparent bg-clip-text
           drop-shadow-lg tracking-wide uppercase relative inline-block">{{ $brand->brand_name }}</h1>
        @endforeach

        <div class="space-y-6">
            @foreach ($products as $product)
            <div
                class="gap-[4%] p-4 rounded-lg flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">


                <!-- Product Image -->

                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                    class="mb-[8%] shadow-[0_3px_10px_rgb(0,0,0,0.2)] w-full max-w-xs h-auto object-contain rounded-lg md:max-h-auto md:mb-0">


                <!-- Product Details -->
                <div class="flex-1">

                    <div>
                        <h2 class="text-lg font-bold">{{ $product->name }}</h2> <!-- Added spacing -->
                        <p class="text-gray-700">{{ Str::limit($product->description, 200) }}</p>
                    </div>

                    <!-- Price & Shipping Fee -->
                    <div class="mt-4">

                        <p class="font-bold text-blue-600 text-xl"> ₱{{ $product->price }}</p>
                        <p class="text-sm text-gray-600">Shipping Fee: ₱{{ $product->shipping_fee }}</p>
                    </div>

                    <!-- Success Alert -->
                    <div class="fixed top-[9%] right-[6%] sm:top-[8%] sm:right-[9%] max-w-xs sm:w-96 shadow-lg rounded-lg flex"
                        x-show="showAlert" x-transition>

                        <!-- Left Colored Icon Box -->
                        <div class="bg-green-500 py-3 px-4 sm:py-4 sm:px-6 rounded-l-lg flex items-center">
                            <svg class="h-6 w-6 sm:h-8 sm:w-8 text-slate-100" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                        </div>

                        <!-- Alert Message -->
                        <div
                            class="px-3 py-2 sm:px-4 sm:py-3 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                            <div class="text-sm sm:text-base" x-text="alertMessage"></div>

                            <!-- Close Button -->
                            <button @click="showAlert = false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-gray-700"
                                    viewBox="0 0 16 16" width="18" height="18">
                                    <path fill-rule="evenodd"
                                        d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Success Alert End -->



                    <!-- Quantity & Add to Cart -->
                    <div class="mt-6 flex space-x-4 items-center">

                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button @click="$refs.qty{{ $product->id }}.stepDown()"
                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-l-lg">−</button>

                            <input type="number" value="1" min="1" class="w-16 border-x border-gray-300 p-2 text-center outline-none appearance-none 
                                [-moz-appearance:textfield]" x-ref="qty{{ $product->id }}">

                            <button @click="$refs.qty{{ $product->id }}.stepUp()"
                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-r-lg">+</button>
                        </div>

                        <style>
                        /* Hide number input arrows */
                        input[type="number"]::-webkit-inner-spin-button,
                        input[type="number"]::-webkit-outer-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                        </style>

                        <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700" @click="addToCart({ 
                                    id: {{ $product->id }}, 
                                    name: '{{ $product->name }}', 
                                    price: {{ $product->price }}, 
                                    shipping_fee: {{ $product->shipping_fee }}, 
                                    image: '{{ $product->image_path }}', 
                                    quantity: parseInt($refs.qty{{ $product->id }}.value) 
                                })">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>


                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>

    <!-- Alpine.js Cart Functionality -->
    <script>
    function cartStore() {
        return {
            cart: [],
            isCartOpen: false,
            alertMessage: "",
            showAlert: false,

            init() {
                this.loadCart(); // Load the cart from sessionStorage on init
            },

            toggleCart() {
                this.isCartOpen = !this.isCartOpen;
            },

            closeCart() {
                this.isCartOpen = false;
            },

            addToCart(product) {
                let existing = this.cart.find(item => item.id === product.id);
                if (existing) {
                    // If the item already exists, increase the quantity
                    existing.quantity += product.quantity;
                } else {
                    // If the item doesn't exist, add a new item to the cart
                    this.cart.push({...product});  // Use spread to avoid reference issues
                }
                this.saveCart();  // Save the cart to sessionStorage
                this.showSuccessAlert();
            },

            removeFromCart(index) {
                this.cart.splice(index, 1);  // Remove the item at the given index
                this.saveCart();  // Save the updated cart to sessionStorage
            },

            saveCart() {
                // Save the cart to sessionStorage
                sessionStorage.setItem('cart', JSON.stringify(this.cart));
                console.log("Cart saved in sessionStorage:", this.cart);  // Debug message
            },

            loadCart() {
                let storedCart = sessionStorage.getItem('cart');
                if (storedCart) {
                    this.cart = JSON.parse(storedCart);
                    console.log("Cart loaded from sessionStorage:", this.cart);  // Debug message
                }
            },

            totalPrice() {
                return this.cart.reduce((sum, item) => sum + ((item.price + item.shipping_fee) * item.quantity), 0)
                    .toFixed(2);  // Calculate total price including quantity and shipping fee
            },

            totalCartItems() {
                return this.cart.reduce((sum, item) => sum + item.quantity, 0);  // Get the total number of items in the cart
            },

            showSuccessAlert() {
                this.alertMessage = `${this.totalCartItems()} item(s) added to cart!`;  // Alert for adding items
                this.showAlert = true;
                setTimeout(() => {
                    this.showAlert = false;
                }, 5000);  // Hide alert after 5 seconds
            }
        };
    }
</script>




</body>

</html>