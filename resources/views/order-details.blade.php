<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
@include('includes.admin-header')

<body class="bg-gray-100">
    

   

    <div class="container w-full max-w-7xl mt-0 mb-0 m-auto p-4 sm:p-8">
    <h2 class="text-xl font-bold mb-4">Order Details</h2>
        <!-- Search Bar with Button -->
        <div class="flex flex-col sm:flex-row items-center mb-8 gap-4">
            <div class="w-full">
                <form action="" method="GET" class="w-full">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" name="search" id="default-search" value="{{ $search }}"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-light-blue-500 focus:border-light-blue-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-light-blue-500 dark:focus:border-light-blue-500"
                            placeholder="Search by name..." />
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Search
                        </button>
                    </div>
                    <input type="hidden" name="view" value="{{ $view }}">
                </form>
            </div>


            <!-- Order View Filters -->


            <a href="?view=all&search={{ $search }}"
                class="w-full sm:w-[25%] px-4 py-3 rounded bg-gray-300 text-gray-800 {{ request('view') == 'all' || !request('view') ? 'bg-blue-500' : '' }}">
                All Orders
            </a>

            <a href="?view=pending&search={{ $search }}"
                class="w-full sm:w-[25%] px-4 py-3 rounded bg-yellow-600 text-white {{ request('view') == 'pending' ? 'bg-yellow-600' : '' }}">
                Pending Orders <span class="ml-2">({{ $pendingCount }})</span>
            </a>

            <a href="?view=shipped&search={{ $search }}"
                class="w-full sm:w-[25%] px-4 py-3 rounded bg-green-600 text-white {{ request('view') == 'shipped' ? 'bg-green-600' : '' }}">
                Shipped Orders <span class="ml-2">({{ $shippedCount }})</span>
            </a>



        </div>



        @foreach($checkouts as $checkout)
        <div class="bg-white p-4 rounded-lg shadow-md mb-4 cursor-pointer" x-data="{ open: false, showModal: false }">
            <div class="flex justify-between items-center" @click="open = !open">
                <p class="text-lg font-semibold">
                    Order #{{ $checkout->id }} - {{ $checkout->first_name }} {{ $checkout->last_name }}
                    <span
                        class="ml-2 px-2 py-1 text-sm font-medium rounded {{ $checkout->status == 0 ? 'bg-yellow-500' : 'bg-green-500' }} text-white">
                        {{ $checkout->status == 0 ? 'Pending' : 'Shipped' }}
                    </span>
                </p>
                <svg x-show="!open" class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
                <svg x-show="open" class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 15l-6-6-6 6"></path>
                </svg>
            </div>

            <!-- Order Details Section (Visible when 'open' is true) -->
            <div x-show="open" class="mt-4">
                <div class="bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
                    <!-- Order Summary -->
                    <h3 class="text-xl font-semibold mb-4">Order Summary</h3>

                    <div class="space-y-4 border-b pb-4">
                        @php
                        $cartData = json_decode($checkout->cart_data, true);
                        $grandTotal = $cartData['grand_total'] ?? 0;
                        unset($cartData['grand_total']);
                        @endphp

                        @foreach($cartData as $item)
                        <div class="flex items-center space-x-4 border rounded-lg p-3">
                            <img src="{{ $item['image'] }}" class="w-16 h-16 object-cover rounded"
                                alt="{{ $item['name'] }}">
                            <div class="flex-grow">
                                <p class="font-semibold">{{ $item['name'] }}</p>
                                <p class="text-sm text-gray-600">Price: <span
                                        class="font-bold">₱{{ number_format($item['price'], 2) }}</span></p>
                                <p class="text-sm text-gray-600">Shipping: <span
                                        class="font-bold">₱{{ number_format($item['shippingFee'] ?? 0, 2) }}</span></p>
                                <p class="text-sm text-gray-600">Quantity: <span
                                        class="font-bold">{{ $item['quantity'] }}</span></p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Grand Total -->
                    <div class="mt-4 text-lg font-bold text-gray-700 flex gap-4">
                        <span>Grand Total:</span>
                        <span class="text-red-500">₱{{ number_format($grandTotal, 2) }}</span>
                    </div>
                </div>

                <!-- Customer Information Section -->
                <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]">
                    <h3 class="text-xl font-semibold mb-4">Customer Information</h3>
                    <p><strong>Name:</strong> {{ $checkout->first_name }} {{ $checkout->last_name }}</p>
                    <p><strong>Phone:</strong> {{ $checkout->phone }}</p>
                    <p><strong>Address:</strong> {{ $checkout->address }}, {{ $checkout->barangay }}, Zip:
                        {{ $checkout->zip_code }}</p>
                </div>

                <!-- Proof of Payment -->
                <div class="mt-6 bg-white p-6 rounded-lg shadow-[inset_0px_3px_34px_1px_#00000024]"
                    x-data="{ showModal: false }">
                    <h3 class="text-xl font-semibold mb-4">Proof of Payment</h3>
                    <div class="cursor-pointer" @click="showModal = true">
                        <img src="{{ asset('storage/' . $checkout->proof_of_payment) }}"
                            class="w-40 h-40 object-cover mt-2" alt="Proof of Payment">
                        <div class="flex items-center text-blue-600 mt-2">
                            <span class="text-sm">Click to Expand</span>
                            <svg x-show="!showModal" class="ml-2 h-5 w-5 text-gray-600" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6 6-6"></path>
                            </svg>
                            <svg x-show="showModal" class="ml-2 h-5 w-5 text-gray-600" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 15l-6-6-6 6"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div x-show="showModal"
                        class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
                        @click="showModal = false">
                        <div class="bg-white p-4 rounded-lg shadow-lg w-[90%] sm:max-w-[800px]">
                            <img src="{{ asset('storage/' . $checkout->proof_of_payment) }}"
                                class="w-full h-auto object-contain" alt="Proof of Payment">
                            <button @click="showModal = false" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                                Close
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Update Status Form -->
                <form action="{{ route('order.updateStatus', $checkout->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <!-- Use PUT method here -->
                    <div class="flex space-x-4">
                        <button type="submit" name="status" value="1" class="px-4 py-2 rounded bg-green-500 text-white">
                            Mark as Shipped
                        </button>
                        <button type="submit" name="status" value="0"
                            class="px-4 py-2 rounded bg-yellow-500 text-white">
                            Mark as Pending
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

        <!-- Pagination -->
        
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

    </div>
</body>

</html>