<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 py-10">
        
        <!-- Thank You Message -->
        <div class="flex flex-col items-center sm:flex-row sm:items-center sm:justify-start text-green-600 text-3xl font-bold mb-6">
            <svg class="h-12 w-12 text-green-500 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            <span class="text-center sm:text-left">Thank You for Your Order!</span>
        </div>
        <!-- <p class="text-green-500 text-xl mb-4 text-center sm:text-left">
    <strong>Order #:{{ $checkout->id }}</strong> 
</p> -->


        <!-- Order Summary Card -->
        <div class="bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
            <!-- Order Details -->
            <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
           
            <div class="space-y-4 border-b pb-4">
                @php
                    $cartData = json_decode($checkout->cart_data, true);
                    $grandTotal = $cartData['grand_total'] ?? 0;
                    unset($cartData['grand_total']);
                @endphp

                @foreach($cartData as $item)
                    <div class="flex items-center space-x-4 border rounded-lg p-3">
                        <img src="{{ $item['image'] }}" class="w-16 h-16 object-cover rounded" alt="{{ $item['name'] }}">
                        <div class="flex-grow">
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-600">Price: <span class="font-bold">₱{{ number_format($item['price'], 2) }}</span></p>
                            <p class="text-sm text-gray-600">Shipping: <span class="font-bold">₱{{ number_format($item['shippingFee'] ?? 0, 2) }}</span></p>
                            <p class="text-sm text-gray-600">Quantity: <span class="font-bold">{{ $item['quantity'] }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Grand Total -->
            <div class="mt-4 text-lg font-bold text-gray-700 flex justify-between">
                <span>Grand Total:</span>
                <span class="text-red-500">₱{{ number_format($grandTotal, 2) }}</span>
            </div>
        </div>

        <!-- Customer Information Section -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
            <h3 class="text-xl font-semibold mb-4">Customer Information</h3>
            <p><strong>Name:</strong> {{ $checkout->first_name }} {{ $checkout->last_name }}</p>
            <p><strong>Phone:</strong> {{ $checkout->phone }}</p>
            <p><strong>Address:</strong> {{ $checkout->address }}, {{ $checkout->barangay }}, Zip: {{ $checkout->zip_code }}</p>
        </div>

        <!-- Proof of Payment -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
            <h3 class="text-xl font-semibold mb-4">Proof of Payment</h3>
            @if($checkout->proof_of_payment)
                <img src="{{ asset('storage/' . $checkout->proof_of_payment) }}" class="w-40 h-40 object-cover mt-2" alt="Proof of Payment">
            @else
                <p class="text-sm text-gray-600">No proof of payment uploaded.</p>
            @endif
        </div>
    </div>
</body>
</html>
