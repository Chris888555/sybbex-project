<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css'])

    <script>
    function copyReferralLink() {
        const referralLink = document.getElementById('referral-link');
        navigator.clipboard.writeText(referralLink.value)
            .then(() => {
                document.getElementById('copy-feedback').classList.remove('hidden');
                setTimeout(() => document.getElementById('copy-feedback').classList.add('hidden'), 2000);
            })
            .catch(err => console.error('Failed to copy:', err));
    }
    </script>
</head>

<body class="bg-gray-100">

    <!-- Include Sidebar -->
    @include('includes.student-header')

    <!-- Main Content Area -->
    <main class="flex flex-col items-center justify-start mt-10 px-4">
        <!-- Dashboard Content -->
        <div
            class="bg-white p-6 rounded-xl shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px] w-full max-w-lg sm:max-w-[800px] text-center">

            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Invite Your Friends</h2>
            <p class="text-gray-600 mb-4">Share your referral link and earn rewards when they sign up!</p>

            <!-- Referral Link Input -->
            <div class="flex justify-center items-center mb-4">
                <input type="text" id="referral-link"
                    value="{{ url('/register?ref=' . auth()->user()->referral_code) }}"
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 focus:ring-2 focus:ring-blue-500"
                    readonly>
            </div>

            <!-- Buttons Container -->
            <div class="space-y-4 sm:space-y-0 sm:flex sm:space-x-4 sm:justify-center">

                <!-- Copy Button -->
                <button onclick="copyReferralLink()"
                    class="w-full sm:w-auto flex items-center justify-center bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="h-5 w-5 mr-2 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <rect x="8" y="8" width="12" height="12" rx="2" />
                        <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
                    </svg>
                    Copy Link
                </button>

                <!-- View Button -->
                <a href="{{ url('/register?ref=' . auth()->user()->referral_code) }}"
                    class="w-full sm:w-auto flex items-center justify-center bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                    target="_blank">
                    <svg class="h-5 w-5 mr-2 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <circle cx="12" cy="12" r="2" />
                        <path d="M22 12c-2 -5 -7 -8 -10 -8s-8 3 -10 8c2 5 7 8 10 8s8 -3 10 -8" />
                    </svg>
                    View Referral Link
                </a>

            </div>

            <!-- Copy Link Feedback -->
            <p id="copy-feedback" class="mt-4 text-green-600 font-semibold text-lg hidden">Referral link copied to
                clipboard!</p>
        </div>
    </main>

</body>

</html>