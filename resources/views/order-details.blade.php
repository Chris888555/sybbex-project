<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-600 shadow-md py-4">
        <div class="container mx-auto text-center text-white">
            <h1 class="text-3xl font-bold">Order Details</h1>
        </div>
    </header>

    <div class="container mx-auto p-6 mt-8">
    <div class="flex space-x-4 mb-6">
    <a href="?view=all" class="px-4 py-2 rounded bg-gray-300 text-gray-800 {{ request('view') == 'all' || !request('view') ? 'bg-blue-500' : '' }}">
        All Orders
    </a>
    
    <a href="?view=pending" class="px-4 py-2 rounded bg-yellow-500 text-white {{ request('view') == 'pending' ? 'bg-yellow-600' : '' }}">
        Pending Orders
    </a>
    
    <a href="?view=shipped" class="px-4 py-2 rounded bg-green-500 text-white {{ request('view') == 'shipped' ? 'bg-green-600' : '' }}">
        Shipped Orders
    </a>
</div>

@foreach($checkouts as $checkout)
    <div class="bg-white p-4 rounded-lg shadow-md mb-4 cursor-pointer" x-data="{ open: false }">
        <div class="flex justify-between items-center" @click="open = !open">
            <p class="text-lg font-semibold">
                Order #{{ $checkout->id }} - {{ $checkout->first_name }} {{ $checkout->last_name }}
                <span class="ml-2 px-2 py-1 text-sm font-medium rounded {{ $checkout->status == 0 ? 'bg-yellow-500' : 'bg-green-500' }} text-white">
                    {{ $checkout->status == 0 ? 'Pending' : 'Shipped' }}
                </span>
            </p>
            <svg x-show="!open" class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6"></path>
            </svg>
            <svg x-show="open" class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 15l-6-6-6 6"></path>
            </svg>
        </div>

        <div x-show="open" class="mt-4 border-t pt-4">
            <p class="text-sm text-gray-600">Order Date: {{ $checkout->created_at->format('F j, Y, g:i a') }}</p>
            <div class="mt-4 space-y-4">
                @php $cartData = json_decode($checkout->cart_data); @endphp
                @foreach($cartData as $item)
                    <div class="flex justify-between items-center border-b py-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-[80px] h-[80px] object-contain">
                            <div>
                                <p class="font-semibold">{{ $item->name }}</p>
                                <p class="text-sm text-gray-600">Price: ₱{{ number_format($item->price, 2) }}</p>
                                <p class="text-sm text-gray-600">Shipping Fee: ₱{{ number_format($item->shipping_fee, 2) }}</p>
                                <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-between font-semibold text-lg">
                <p>Total Price:</p>
                <p class="text-blue-600">
                    ₱{{ number_format(array_sum(array_map(function($item) { return ($item->price + $item->shipping_fee) * $item->quantity; }, $cartData)), 2) }}
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-md mt-4">
                <h3 class="text-lg font-semibold mb-2">Shipping Information</h3>
                <p><strong>Name:</strong> {{ $checkout->first_name }} {{ $checkout->last_name }}</p>
                <p><strong>Phone:</strong> {{ $checkout->phone }}</p>
                <p><strong>Address:</strong> {{ $checkout->address }}</p>
                <p><strong>Barangay:</strong> {{ $checkout->barangay }}</p>
                <p><strong>Zip Code:</strong> {{ $checkout->zip_code }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-md mt-4">
                <h3 class="text-lg font-semibold mb-2">Payment Option</h3>
                <p>{{ $checkout->payment_option }}</p>
            </div>

            @if ($checkout->proof_of_payment)
                <div class="bg-gray-50 p-4 rounded-lg shadow-md mt-4">
                    <h3 class="text-lg font-semibold mb-2">Proof of Payment</h3>
                    <img src="{{ Storage::url($checkout->proof_of_payment) }}" alt="Proof of Payment" class="w-32 h-32 object-cover rounded-md">
                </div>
            @endif

            <div class="bg-gray-50 p-4 rounded-lg shadow-md mt-4">
                <h3 class="text-lg font-semibold mb-2">Order Status</h3>
                <form action="{{ route('order.updateStatus', $checkout->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="border rounded p-2">
                        <option value="0" {{ $checkout->status == 0 ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ $checkout->status == 1 ? 'selected' : '' }}>Shipped</option>
                    </select>
                    <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- ✅ Pagination (Page Numbers on Left, Always Show Prev/Next on Right) -->
<!-- ✅ Pagination (Page Numbers Wrap, Active Page in Blue) -->
<div class="mt-6">
    <p class="text-gray-600 mb-4"> 
        Total: {{ $checkouts->total() }} results
    </p>
    <div class="flex flex-wrap gap-2">
        @foreach ($checkouts->links()->elements[0] as $page => $url)
            <a href="{{ $url }}" 
               class="px-4 py-2 rounded-lg transition 
               {{ $page == $checkouts->currentPage() ? 'bg-blue-500 text-white font-semibold' : 'bg-gray-200 hover:bg-gray-300' }}">
                {{ $page }}
            </a>
        @endforeach
    </div>
</div>


</body>
</html>
