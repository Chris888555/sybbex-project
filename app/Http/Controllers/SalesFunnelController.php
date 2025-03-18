<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SalesFunnelController extends Controller
{
    public function showFunnel()
    {
        // Get the logged-in user
        $user = auth()->user();

        // If no user is logged in, show a 404 error
        if (!$user) {
            abort(404, 'Sales funnel not found');
        }

        // Load the sales funnel page for the logged-in user
        return view('sales_funnel', compact('user'));
    }

    public function updateSubdomain(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subdomain' => 'required|string|unique:users,subdomain',
        ]);

        // Find the logged-in user and update their subdomain
        $user = User::findOrFail($request->user_id);
        $user->subdomain = $request->subdomain;
        $user->save();

        return back()->with('success', 'Subdomain updated successfully!');
    }
}
