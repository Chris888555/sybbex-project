<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    
    @vite(['resources/css/app.css'])

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Shop</h1>
        <button id="cart-icon" class="fixed top-4 right-4 bg-blue-500 text-white p-4 rounded-full shadow-lg">
            <i class="fas fa-shopping-cart"></i> (<span id="cart-count">0</span>)
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="border p-4 rounded-lg shadow-lg">
                    <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-48 object-cover rounded-lg mb-4" alt="{{ $product->name }}">
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-700">{{ $product->description }}</p>
                    <p class="text-lg font-bold mt-2">&#8369;{{ number_format($product->price, 2) }}</p>
                    <input type="number" min="1" value="1" class="quantity-input mt-2 p-2 border rounded w-full" data-product-id="{{ $product->id }}" data-shipping-rules='{{ json_encode($product->shipping_rules) }}'>
                    <button class="add-to-cart mt-2 bg-blue-500 text-white px-4 py-2 rounded w-full" data-product-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div id="cart-sidebar" class="fixed right-0 top-0 w-80 h-full bg-white shadow-lg transform translate-x-full transition-transform">
        <div class="p-4">
            <h2 class="text-2xl font-bold">Cart</h2>
            <ul id="cart-items" class="mt-4"></ul>
            <p class="mt-4 font-bold">Total: <span id="cart-total">0.00</span></p>
            <button id="close-cart" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>

    <script>
        let cart = [];

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                let productId = this.dataset.productId;
                let name = this.dataset.name;
                let price = parseFloat(this.dataset.price);
                let quantityInput = document.querySelector(`.quantity-input[data-product-id='${productId}']`);
                let quantity = parseInt(quantityInput.value);
                let shippingRules = JSON.parse(quantityInput.dataset.shippingRules);
                
                let shippingFee = calculateShipping(quantity, shippingRules);
                let totalPrice = (price * quantity) + shippingFee;

                let existingProduct = cart.find(item => item.id === productId);
                if (existingProduct) {
                    existingProduct.quantity += quantity;
                    existingProduct.shippingFee = calculateShipping(existingProduct.quantity, shippingRules);
                    existingProduct.totalPrice = (existingProduct.price * existingProduct.quantity) + existingProduct.shippingFee;
                } else {
                    cart.push({ id: productId, name, price, quantity, shippingFee, totalPrice });
                }

                updateCart();
            });
        });
        
        function calculateShipping(quantity, rules) {
            let weight = quantity * 500; // Assume each item weighs 500g
            for (let rule of rules) {
                if (weight >= rule.min_weight && weight <= rule.max_weight) {
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
            
            cart.forEach(item => {
                total += item.totalPrice;
                count += item.quantity;
                cartItems.innerHTML += `<li class='border-b p-2 flex justify-between'>
                    <div>
                        <p>${item.name} x${item.quantity}</p>
                        <p>Shipping: &#8369;${item.shippingFee.toFixed(2)}</p>
                    </div>
                    <p class='font-bold'>&#8369;${item.totalPrice.toFixed(2)}</p>
                </li>`;
            });
            
            cartTotal.textContent = total.toFixed(2);
            cartCount.textContent = count;
        }
        
        document.getElementById('cart-icon').addEventListener('click', function () {
            document.getElementById('cart-sidebar').classList.remove('translate-x-full');
        });
        
        document.getElementById('close-cart').addEventListener('click', function () {
            document.getElementById('cart-sidebar').classList.add('translate-x-full');
        });
    </script>
</body>
</html>
