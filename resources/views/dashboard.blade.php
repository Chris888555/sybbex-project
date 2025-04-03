<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Dashboard</title>
    @vite(['resources/css/app.css'])
</head>

@include('includes.nav')

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold text-blue-900">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="mt-4 text-lg text-gray-700">
                We're excited to have you as a part of our community! You can now start sharing your landing page link
                with your clients to generate leads and collect contacts.
            </p>
        </div>

        <!-- Funnel Link Section -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-900">Your Landing Page Link</h2>
            <p class="mt-4 text-lg text-gray-700">
                Simply click the button below to go to the next page where you can copy your landing page link and share
                it with your clients:
            </p>
            <div class="flex items-center mt-4 space-x-2">
                <!-- Redirect Button to the next page -->
                <a href="{{ route('create-landing-page') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
                    Go to Landing Page
                </a>
            </div>
            <p class="mt-2 text-sm text-gray-600">Share this link with your clients to start collecting contacts and
                leads.</p>
        </div>


        <!-- Lead Collection and Follow-up Section -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-blue-900">Collect Contacts and Follow Up</h3>
            <p class="mt-4 text-lg text-gray-700">
                Once you've shared your link, you can start collecting contact information from potential clients who
                sign up.
                You can follow up with them to answer any questions or close deals.
            </p>
        </div>

        <!-- Note Section -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-blue-900">Important Notes:</h3>
            <ul class="mt-4 text-lg text-gray-700 list-disc pl-5">
                <li>After sharing the link, you can start collecting contacts directly through the landing page.</li>
                <li>Monitor your contacts and follow up with them to close deals and grow your business.</li>
                <li>You don't need to make changes to your landing page; just share the link and start collecting leads!
                </li>
            </ul>
        </div>
    </div>

    <script>
    function copyLink() {
        // Dynamically generate the landing page link using the route
        const landingPageLink = "{{ url('create-landing-page/' . Auth::user()->subdomain) }}";

        // Create an input to select and copy the link
        const input = document.createElement('input');
        input.value = landingPageLink;
        document.body.appendChild(input);
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to clipboard
        document.execCommand('copy');
        document.body.removeChild(input);

        // Provide feedback to the user
        alert('Landing page link copied to clipboard!');
    }
    </script>
</body>

</html>