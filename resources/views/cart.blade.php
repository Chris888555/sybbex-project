<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF token -->
    <title>Cart Page</title>
    <script>
        // Function to send the cart data to the server
        function sendCartToServer() {
            let cartData = JSON.parse(sessionStorage.getItem('cart'));  // Get cart from sessionStorage

            if (cartData) {
                // Send AJAX request to the Laravel controller to save the cart data
                fetch('/api/save-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token
                    },
                    body: JSON.stringify({ cart: cartData })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Cart saved on server:', data);  // Server response
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</head>
<body>
    <!-- Example Cart Page -->
    <div>
        <h1>Your Cart</h1>
        <button id="checkoutButton" onclick="sendCartToServer()">Proceed to Checkout</button>
    </div>

    <script>
        // Example code to load cart data from sessionStorage and display it on the page
        window.onload = function() {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            console.log(cart);
            // Here you can display cart items on the page
        }
    </script>
</body>
</html>
