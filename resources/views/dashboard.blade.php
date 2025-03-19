<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css'])
</head>
@include('includes.student-header')
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Network Marketing Dashboard</h1>
        
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Referrals</h2>
                <p class="text-2xl font-bold">120</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Earnings</h2>
                <p class="text-2xl font-bold">$1,250</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">New Leads</h2>
                <p class="text-2xl font-bold">15</p>
            </div>
        </div>

        <!-- Referral Link -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-lg font-semibold">Your Referral Link</h2>
            <input type="text" class="w-full p-2 border rounded mt-2" value="https://yourwebsite.com/referral?code=ABC123" readonly>
        </div>

        <!-- Team Structure -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-2">Team Members</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Referrals</th>
                        <th class="border p-2">Earnings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2">John Doe</td>
                        <td class="border p-2">25</td>
                        <td class="border p-2">$500</td>
                    </tr>
                    <tr>
                        <td class="border p-2">Jane Smith</td>
                        <td class="border p-2">18</td>
                        <td class="border p-2">$300</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Recent Activities</h2>
            <ul>
                <li class="border-b p-2">John Doe referred a new member.</li>
                <li class="border-b p-2">You earned $50 from referrals.</li>
                <li class="border-b p-2">Jane Smith reached 18 referrals.</li>
            </ul>
        </div>
    </div>
</body>

</html>