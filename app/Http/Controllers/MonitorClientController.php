<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;

use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class MonitorClientController extends Controller
{
    /**
     * Display a list of all users or only the user's clients if not admin.
     */
    public function index()
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            // If not admin, only show the client's data related to the logged-in user
            $clients = Client::where('user_id', auth()->id())->get();
            return view('mysignup', compact('clients'));
        }

        // If the user is an admin, fetch all users with the number of clients
        $users = User::withCount('clients')->get();

        return view('mysignup', compact('users'));
    }

    /**
     * Fetch clients signed up by a specific user.
     */
    public function getClients($userId)
    {
        \Log::info("Fetching clients for user ID: " . $userId);

        // Fetch clients and include page_id
        $clients = Client::where('user_id', $userId)
                         ->select('name', 'email', 'phone', 'page_id') // Add page_id
                         ->get();

        return response()->json(['clients' => $clients]);
    }


// export csv
    public function exportClients()
    {
        // Fetch all clients from all users (consider adding necessary filters here)
        $clients = Client::all();

        // Prepare CSV data
        $csvData = "Name,Email,Phone\n";

        foreach ($clients as $client) {
            $csvData .= "{$client->name},{$client->email},{$client->phone}\n";
        }

        // Generate CSV file and make it available for download
        $filename = 'clients_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}


