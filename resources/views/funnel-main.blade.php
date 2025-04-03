<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Funnel Links</title>
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@latest/src/css/icons.css">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<!-- Include Sidebar -->
@include('includes.nav')

<body class="bg-gray-100 p-5 md:p-10 ">
    <div class="max-w-sm md:max-w-[800px] mx-auto w-[90%] bg-white shadow-lg rounded-lg p-6 mt-10">
        <h1 class="text-2xl md:text-3xl font-bold text-center mb-4">Sales Funnel Links</h1>
        <p class="text-gray-600 text-center mb-4">Manage and share your custom funnel links.</p>

        <ul class="space-y-4">
            <!-- Loop through only the logged-in user's data -->
            <li class="bg-gray-200 p-4 rounded-lg shadow-md">

                <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                    <p class="text-blue-600 font-medium text-center break-all">{{ url($user->subdomain) }}</p>
                </div>

                <div class="flex flex-wrap justify-center gap-2 mt-4">
    <!-- Copy Link Button -->
    <button onclick="copyToClipboard('{{ url($user->subdomain) }}')"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center w-full md:w-auto">
        <i class="ph ph-copy mr-2"></i> Copy Link
    </button>

    <!-- View Funnel Button -->
    <a href="{{ url($user->subdomain) }}" target="_blank"
        class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 flex items-center w-full md:w-auto">
        <i class="ph ph-eye mr-2"></i> View Funnel
    </a>

    <!-- Update Subdomain Button -->
    <button onclick="openModal('{{ $user->id }}', '{{ $user->subdomain }}')"
        class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 flex items-center w-full md:w-auto">
        <i class="ph ph-pencil-simple mr-2"></i> Update Subdomain
    </button>

   <!-- Edit Funnel Button -->
<a href="{{ route('edit-funnel') }}"
    class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-600 hover:shadow-lg flex items-center w-full md:w-auto transition-all duration-300">
    <i class="ph ph-pencil mr-2"></i> Edit Funnel
</a>



            </li>
        </ul>

    </div>


    @if(session('success'))
    <div id="successAlert"
        class="fixed top-[90px] right-5 bg-green-100 text-green-700 border border-green-400 p-3 rounded-md shadow-lg flex items-center space-x-2">
        <i class="ph ph-check-circle text-green-600 text-lg"></i>
        <span>{{ session('success') }}</span>
    </div>
    <script>
    setTimeout(() => {
        document.getElementById('successAlert').style.display = 'none';
    }, 5000); // Hide after 3 seconds
    </script>
    @endif

    @if($errors->has('subdomain'))
    <div id="errorAlert"
        class="fixed top-[90px] right-5 bg-red-100 text-red-700 border border-red-400 p-3 rounded-md shadow-lg">
        <i class="ph ph-warning-circle"></i> <!-- Warning Icon -->
        <span>{{ $errors->first('subdomain') }}</span>
    </div>
    <script>
    setTimeout(() => {
        document.getElementById('errorAlert').style.display = 'none';
    }, 5000); // Hide after 3 seconds
    </script>
    @endif

    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-xl font-bold mb-4 text-center">Update Subdomain</h2>

            <form id="updateForm" method="POST">
                @csrf
                <input type="hidden" id="userId" name="user_id">

                <label class="block text-gray-600 mb-2">New Subdomain</label>
                <input type="text" id="subdomain" name="subdomain" class="w-full p-2 border rounded-lg mb-2" required
                    oninput="validateSubdomain(this)">

                <small id="errorText"
                    class="hidden bg-red-100 text-red-700 border border-red-400 p-2 rounded-md shadow-lg block">
                    Only letters, numbers, and hyphens (-) are allowed.
                </small>

                <div class="flex flex-wrap justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg w-full md:w-auto">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 w-full md:w-auto">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container w-full max-w-7xl mt-6 mb-10 mx-auto sm:p-8">
    <div x-data="{ open: false }" class="w-[90%] sm:max-w-[800px] mx-auto p-6 bg-white shadow-lg rounded-xl">
        <button @click="open = !open" class="text-xl font-bold text-gray-800 w-full text-left flex justify-between items-center">
            Paano Gamitin ang Sales Funnel
            <span x-text="open ? '▲' : '▼'"></span>
        </button>
        
        <div x-show="open" x-transition class="mt-4 bg-yellow-300 p-6 rounded-lg">
            <p class="text-gray-600 mb-4">Ang sales funnel ay proseso ng pag-convert ng mga bisita sa customers. Narito ang simpleng hakbang:</p>

            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                <li><span class="font-semibold">Maghanap ng mga potensyal na kliyente –</span> Mahalaga na may makakita ng iyong sales funnel. Maaari kang mag-run ng ads o mag-post sa social media upang makahanap ng mga interesadong kliyente.</li>
                <li><span class="font-semibold">Ipasok sila sa sales funnel –</span> Siguraduhing dumaan sila sa sales funnel upang ma-educate sila nang tama tungkol sa iyong produkto o serbisyo.</li>
                <li><span class="font-semibold">Gawing epektibo ang follow-up –</span> Mahalaga ang follow-up upang mapabalik sila sa iyong funnel. Maaari kang magbigay ng valuable information na makakatulong sa kanila sa pagdedesisyon.</li>
            </ul>

            <p class="mt-4 text-gray-800 font-semibold">Tandaan, ang tamang diskarte at tuloy-tuloy na follow-up ang susi sa mas mataas na conversion!</p>
        </div>
    </div>
</div>

    <script>
    function copyToClipboard(link) {
        navigator.clipboard.writeText(link).then(() => {
            // ✅ SweetAlert Success Message
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'The link has been copied to clipboard.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }

    function openModal(userId, subdomain) {
        document.getElementById('userId').value = userId;
        document.getElementById('subdomain').value = subdomain;

        // Set correct form action dynamically
        document.getElementById('updateForm').action = "/subdomain/update/" + userId;

        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
    </script>

    <script>
    function validateSubdomain(input) {
        let regex = /^[a-zA-Z0-9-]+$/; // Allowed: letters, numbers, and hyphen
        let errorText = document.getElementById("errorText");

        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^a-zA-Z0-9-]/g, ""); // Remove invalid characters
            errorText.classList.remove("hidden");
        } else {
            errorText.classList.add("hidden");
        }
    }
    </script>

</body>

</html>