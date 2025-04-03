@if(!Auth::check())
<script>
window.location = "{{ route('admin.login') }}";
</script>
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

@include('includes.nav')

<body class="bg-gray-50">

     

          


    <div class="container mx-auto py-6 px-4 mt-10">

         <!-- Success Message -->
            @if(session('success'))
            <div id="success-message"
                <div class="mt-10 flex w-full  mx-auto  overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
                <div class="flex items-center justify-center w-12 bg-emerald-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                        <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
  <script>
            // Hide the success message after 3 seconds
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
            </script>
            @endif

        <h1 class="text-xl font-bold mb-6">Manage Users</h1>

        <div class="flex flex-wrap items-center gap-4 mb-6">
            <!-- Search Form -->
            <form action="{{ route('admin.manage-users') }}" method="GET"
                class="flex items-center w-full sm:w-auto mb-4 sm:mb-0">
                <input type="text" name="search" placeholder="Search by name or email"
                    class="rounded-r-none border-r-0 px-4 py-2 border rounded-md w-96 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-light-blue-500 focus:border-light-blue-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-light-blue-500 dark:focus:border-light-blue-500"
                    value="{{ $search }}">
                <input type="hidden" name="view" value="{{ $view }}"> <!-- Ensure 'view' is passed as a hidden field -->
                <button type="submit"
                    class="border border-blue-500 rounded-l-none px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Search
                </button>
            </form>

            <!-- Buttons to switch between approved and pending users -->
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <button
                    class="px-4 py-2 border border-gray-200 bg-gray-200 text-black rounded-md hover:bg-gray-300 w-full sm:w-auto"
                    onclick="window.location='?view=approved&search={{ $search }}'">
                    Approved Users ({{ $totalApprovedUsers }})
                </button>
                <button
                    class="px-4 py-2  border border-blue-500 bg-blue-500 text-white rounded-md hover:bg-blue-600 w-full sm:w-auto"
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
                <table class="w-full border-collapse border bg-white border-gray-300">
                    <thead class="bg-gray-100">
                         <tr class="bg-[#3e377b] text-white ">
                            <th class="px-4 py-2 border-b text-left">Name</th>
                            <th class="px-4 py-2 border-b text-left">Email</th>
                            <th class="px-4 py-2 border-b text-left">Status</th>
                            <th class="px-4 py-2 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                         <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                           
                            <td class="px-4 py-2 border-b"
                            style="word-break: break-all; max-width: 150px;">
                            {{ $user->email }}
                        </td>
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
                                    <form action="{{ route('users.promoteToAdmin', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:text-green-700">
                                            <i class="fas fa-user-shield mr-1"></i> Make Admin
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.revertToRegular', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="text-orange-500 hover:text-orange-700">
                                            <i class="fas fa-user-alt-slash mr-1"></i> Revert Admin
                                        </button>
                                    </form>
                                    @endif


                                    <!-- New Revert to Pending Button -->
                                    <form action="{{ route('users.revertToPending', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-clock mr-1"></i> Revert Pending
                                        </button>
                                    </form>
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