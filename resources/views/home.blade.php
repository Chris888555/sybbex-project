<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sybbex Realty Philippines</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .welcome-text {
            font-size: 30px;
            font-weight: bold;
            background: linear-gradient(to bottom right, #16a34a, #3b82f6);
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            margin-top: 20px;
        }

        .modern-trading-text {
            font-size: 20px;
            font-weight: bold;
            color: #4b5563;
            margin-bottom: 1rem;
        }

        .main-paragraph {
            font-size: 15px;
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        /* Responsive Design */
        @media screen and (min-width: 640px) {
            .welcome-text {
                font-size: 45px;
            }

            .modern-trading-text {
                font-size: 30px;
            }

            .main-paragraph {
                font-size: 20px;
            }
        }
    </style>
</head>

@include('includes.main-header')

<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <!-- Main Content Wrapper -->
    <main class="flex-grow flex flex-col items-center justify-center mt-[10%]">
        <div class="p-8 w-full max-w-4xl text-center">
            
            <!-- Custom Selector for the Welcome Header -->
            <h2 class="welcome-text">
                Welcome to Realty Philippines
            </h2>

            <!-- Custom Selector for the Real Estate Header -->
            <h2 class="modern-trading-text">
                Your Gateway to Premium Real Estate Properties
            </h2>

            <!-- Custom Selector for the Paragraph Text -->
            <p class="main-paragraph">
                Discover a seamless real estate experience with Realty Philippines. Whether you're looking for the perfect home, a prime residential lot, or a strategic commercial property, we are here to help. Our dedicated team offers expert guidance, personalized solutions, and exclusive listings to match your needs. With a commitment to integrity and excellence, we make property buying effortless and rewarding. Let’s turn your real estate dreams into reality!
            </p>
        </div>
    </main>

    @include('includes.footer')

</body>

</html>
