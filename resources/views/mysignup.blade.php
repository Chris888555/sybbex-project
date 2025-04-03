<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Clients</title>
    @vite(['resources/css/app.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
.wrap-text {
    max-width: 150px;
    /* Adjust based on your table design */
    word-break: break-word;
    /* Break the word if it overflows */
    overflow-wrap: break-word;
}
</style>
@include('includes.nav')
<body class="bg-gray-100">

    <div class="container mx-auto py-6 px-4 mt-10">
        <h2 class="text-2xl font-bold mb-4">Client List</h2>

        @if(auth()->user()->is_admin == 1)
        <div class="py-4  mb-4">
            <a href="{{ route('clients.export') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Export All Clients CSV
            </a>
        </div>
        @endif


        @if(auth()->user()->is_admin == 1)
        <div class="">
            <table class="w-full border-collapse border bg-white border-gray-300 ">
                <thead>
                    <tr class="bg-[#3e377b] text-white ">
                        <th class="border border-gray-300 p-2">User Name</th>
                        <th class="border border-gray-300 p-2">Email</th>
                        <th class="border border-gray-300 p-2">Client Count</th> <!-- Client Count Column -->
                        <th class="border border-gray-300 p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 p-2">
                            <button class="text-blue-500  show-clients" data-userid="{{ $user->id }}">
                                {{ $user->name }}
                            </button>
                        </td>
                        <td class="border border-gray-300 p-2 wrap-text"
                            style="word-break: break-all; max-width: 150px;">
                            {{ $user->email }}
                        </td>

                        <td class="border border-gray-300 p-2 ">{{ $user->clients_count }}</td>
                        <td class="border border-gray-300 p-2">
                            <button class="text-blue-500  show-clients" data-userid="{{ $user->id }}">
                                View Clients
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if(auth()->user()->is_admin == 0)
        <div class="bg-white p-4 shadow-md rounded-lg">
            <!-- Display client count -->
            <div class="mb-4">
                <span class="text-lg font-semibold">Total Clients: {{ $clients->count() }}</span>
            </div>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2">Client Name</th>
                        <th class="border border-gray-300 p-2">Client Email</th>
                        <th class="border border-gray-300 p-2">Client Phone</th>
                        <th class="border border-gray-300 p-2">Page ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 p-2 wrap-text"
                            style="word-break: break-all; max-width: 150px;">{{ $client->name }}</td>
                        <td class="border border-gray-300 p-2 wrap-text"
                            style="word-break: break-all; max-width: 150px;">{{ $client->email }}</td>
                        <td class="border border-gray-300 p-2 wrap-text"
                            style="word-break: break-all; max-width: 150px;">{{ $client->phone }}</td>
                        <td class="border border-gray-300 p-2 wrap-text"
                            style="word-break: break-all; max-width: 150px;">{{ $client->page_id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif


    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div id="clientsModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden px-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 md:w-1/2">
            <h3 class="text-xl font-bold mb-4">Clients List</h3>

            <!-- Display client count in modal -->
            <div class="mb-4">
                <span class="text-lg font-semibold">Total Clients: <span id="clientCount"></span></span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 mt-2">
                    <thead>
                        <tr class="bg-gray-200 ">
                            <th class="border border-gray-300 p-2">Name</th>
                            <th class="border border-gray-300 p-2">Email</th>
                            <th class="border border-gray-300 p-2">Phone</th>
                            <th class="border border-gray-300 p-2">Page ID</th>
                        </tr>
                    </thead>
                    <tbody id="clientData"></tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-end">
                <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded-lg">Close</button>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        $('.show-clients').click(function() {
            var userId = $(this).data('userid');

            $.ajax({
                url: '/users/' + userId + '/clients',
                type: 'GET',
                success: function(response) {
                    var clients = response.clients;
                    var clientData = '';
                    var clientCount = clients.length; // Get the number of clients

                    // Update the client count in the modal
                    $('#clientCount').text(clientCount);

                    if (clients.length === 0) {
                        clientData =
                            '<tr><td colspan="4" class="text-center p-2">No clients found.</td></tr>';
                    } else {
                        clients.forEach(function(client) {
                            clientData += '<tr>';
                            clientData +=
                                '<td class="border border-gray-300 p-2 wrap-text">' +
                                client.name + '</td>';
                            clientData +=
                                '<td class="border border-gray-300 p-2 wrap-text">' +
                                client.email + '</td>';
                            clientData +=
                                '<td class="border border-gray-300 p-2 wrap-text">' +
                                client.phone + '</td>';
                            clientData +=
                                '<td class="border border-gray-300 p-2 wrap-text">' +
                                client.page_id + '</td>';
                            clientData += '</tr>';
                        });
                    }

                    $('#clientData').html(clientData);
                    $('#clientsModal').removeClass('hidden'); // Show the modal
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Debugging: Log the error message
                    alert('Error fetching clients.');
                }
            });
        });

        // Close modal functionality
        $('#closeModal').click(function() {
            $('#clientsModal').addClass('hidden');
        });
    });
    </script>
</body>

</html>