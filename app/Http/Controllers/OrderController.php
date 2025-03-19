<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderShow(Request $request)
    {
        $view = $request->query('view', 'all');
        $search = $request->query('search', ''); // Get the search term
        
        // Base query
        $query = Checkout::query();
        
        // Apply filters based on view
        if ($view === 'pending') {
            $query->where('status', 0);
        } elseif ($view === 'shipped') {
            $query->where('status', 1);
        }
        
        // Apply search if provided
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }
    
        // Get the counts for pending and shipped orders
        $pendingCount = Checkout::where('status', 0)->count();
        $shippedCount = Checkout::where('status', 1)->count();
    
        // Apply pagination and preserve view and search parameters
        $checkouts = $query->paginate(5)->appends(['view' => $view, 'search' => $search]);
    
        return view('order-details', compact('checkouts', 'view', 'pendingCount', 'shippedCount', 'search'));
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
