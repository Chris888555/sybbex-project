<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Fees</title>
    @vite(['resources/css/app.css'])
</head>

<body class="p-6">
    <h2 class="text-2xl font-bold mb-4">Shipping Fee Settings</h2>

    @if (session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <!-- Add Shipping Fee Form -->
    <form action="{{ route('shipping.fees.store') }}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
        @csrf
        <div class="grid grid-cols-4 gap-4 mb-2">
            <input type="number" step="0.01" name="min_weight" placeholder="Min Weight (kg)" class="border p-2 rounded" required>
            <input type="number" step="0.01" name="max_weight" placeholder="Max Weight (kg)" class="border p-2 rounded" required>

            <select name="pouch_type" class="border p-2 rounded" required>
                <option value="" disabled selected>Select Pouch Type</option>
                <option value="Small Pouch">Small Pouch</option>
                <option value="Medium Pouch">Medium Pouch</option>
                <option value="Large Pouch">Large Pouch</option>
            </select>

            <input type="number" name="shipping_fee" placeholder="Shipping Fee (₱)" class="border p-2 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
    </form>

    <!-- Shipping Fees List -->
    <table class="border w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Min Weight</th>
                <th class="p-2">Max Weight</th>
                <th class="p-2">Pouch Type</th>
                <th class="p-2">Shipping Fee</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shippingFees as $fee)
                <tr class="border-b text-center">
                    <td class="p-2">{{ $fee->min_weight }} kg</td>
                    <td class="p-2">{{ $fee->max_weight }} kg</td>
                    <td class="p-2">{{ $fee->pouch_type }}</td>
                    <td class="p-2">₱{{ $fee->shipping_fee }}</td>
                    <td class="p-2">
                        <form action="{{ route('shipping.fees.destroy', $fee->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
