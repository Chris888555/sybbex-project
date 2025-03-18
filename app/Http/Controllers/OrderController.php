<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderShow(Request $request)
{
    $view = $request->query('view', 'all');

    // Base query
    $query = Checkout::query();

    // Apply filters based on view
    if ($view === 'pending') {
        $query->where('status', 0);
    } elseif ($view === 'shipped') {
        $query->where('status', 1);
    }

    // Apply pagination and preserve view parameter
    $checkouts = $query->paginate(5)->appends(['view' => $view]);

    return view('order-details', compact('checkouts', 'view'));
}



    // ✅ Update Order Status (0 = Pending, 1 = Shipped)
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:0,1', // Ensure the status is either 0 (Pending) or 1 (Shipped)
        ]);

        // Find the order
        $checkout = Checkout::findOrFail($id);
    
        // Update the status
        $checkout->status = $request->status;
        $checkout->save();
    
        // Redirect back with success message
        return back()->with('success', 'Order status updated successfully.');
    }
}
