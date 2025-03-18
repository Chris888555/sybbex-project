@if(!Auth::check())
    <script>window.location = "{{ route('admin.login') }}";</script>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - Manage Users</title>

    <!-- Include Tailwind CSS via Vite -->
    @vite(['resources/css/app.css'])

    <!-- Include FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script>
        // This function updates the URL query without reloading the page
        function updateView(view) {
            window.location.search = '?view=' + view + '&search=' + document.getElementById('search-input').value;
        }
    </script>
</head>

@include('includes.admin-header')
<body class="bg-gray-50">

@if(session('success'))
    <!-- Mobile View -->
    <div id="success-alert" class="alert flex md:hidden items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 
        w-[90%] left-1/2 transform -translate-x-1/2 relative m-0" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>

    <!-- Desktop View -->
    <div id="success-alert-desktop" class="alert hidden md:flex items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 
        max-w-lg fixed top-0 right-0 mt-24 mr-4" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if ($errors->any())
    <!-- Mobile View -->
    <div id="error-alert" class="alert flex md:hidden items-center p-4 mb-4 rounded-md text-sm bg-red-100 text-red-700 border border-red-400 
        w-[90%] left-1/2 transform -translate-x-1/2 relative m-0" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Desktop View -->
    <div id="error-alert-desktop" class="alert hidden md:flex items-center p-4 mb-4 rounded-md text-sm bg-red-100 text-red-700 border border-red-400 
        max-w-lg fixed top-0 right-0 mt-24 mr-4" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Script to Auto-Hide Alerts -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.display = 'none';
            });
        }, 3000); // 3 seconds
    });
</script>



    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Manage Users</h1>

        <div class="flex flex-wrap items-center space-x-2 mb-6">
            <!-- Search Form -->
            <form action="{{ route('admin.manage-users') }}" method="GET" class="flex items-center space-x-2 w-full sm:w-auto mb-4 sm:mb-0">
            <input type="text" name="search" placeholder="Search by name or email" class="px-4 py-2 border rounded-md w-96" value="{{ $search }}">
                <input type="hidden" name="view" value="{{ $view }}"> <!-- Ensure 'view' is passed as a hidden field -->
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Search
                </button>
            </form>

            <!-- Buttons to switch between approved and pending users -->
            <div class="flex space-x-2 w-full sm:w-auto">
                <button 
                    class="px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 w-full sm:w-auto"
                    onclick="window.location='?view=approved&search={{ $search }}'">
                    Approved Users ({{ $totalApprovedUsers }})
                </button>
                <button 
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 w-full sm:w-auto"
                    onclick="window.location='?view=pending&search={{ $search }}'">
                    Pending Users ({{ $totalPendingUsers }})
                </button>
            </div>
        </div>

        <!-- Display the current view (approved or pending) -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">
                
            </h2>

            @if($users->isEmpty())
                <p>No users found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse bg-white shadow-md rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border-b text-left">Name</th>
                                <th class="px-4 py-2 border-b text-left">Email</th>
                                <th class="px-4 py-2 border-b text-left">Status</th>
                                <th class="px-4 py-2 border-b text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border-b">
                                        @if($user->approved)
                                            @if($user->is_admin)
                                                <span class="font-semibold text-blue-500">Admin</span>
                                            @else
                                                <span class="text-green-500 font-semibold">User</span>
                                            @endif
                                        @else
                                            <span class="text-yellow-500 font-semibold">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        <div class="flex space-x-4">
                                            @if($user->approved)
                                                @if(!$user->is_admin)
                                                    <form action="{{ route('users.promoteToAdmin', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-500 hover:text-green-700">
                                                            <i class="fas fa-user-shield mr-1"></i> Make Admin
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.revertToRegular', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-orange-500 hover:text-orange-700">
                                                            <i class="fas fa-user-alt-slash mr-1"></i> Revert Admin
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif

                                            <form action="{{ route('users.delete', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">
                                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                                </button>
                                            </form>

                                            @if(!$user->approved)
                                                <form action="{{ route('users.approve', $user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-500 hover:text-green-700">
                                                        <i class="fas fa-check-circle mr-1"></i> Approve
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-6">
                    <div class="flex justify-start">
                        {{ $users->appends(['view' => $view, 'search' => request()->get('search')])->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    
</body>
</html>
