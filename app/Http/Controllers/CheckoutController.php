<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use Illuminate\Support\Facades\Storage;


class CheckoutController extends Controller
{
    // View the checkout page (cart)
    public function view()
    {
        return view('checkout');  // This is the view you have created for checkout
    }

    // Store the cart data into the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'payment_option' => 'required|string|max:255',
            'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload (Proof of Payment)
        $filePath = null;
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filePath = $file->store('proofpayment_image', 'public');
        }
    
        // Get cart data from the form (which is passed as JSON)
        $cartData = json_decode($request->input('cart_data'), true);
    
        // Compute grand total (items total + shipping fees)
        $grandTotal = array_reduce($cartData, function ($sum, $item) {
            return $sum + ($item['totalPrice'] ?? ($item['price'] * $item['quantity'])) + ($item['shippingFee'] ?? 0);
        }, 0);
    
        // Add grand total to cart data
        $cartData['grand_total'] = $grandTotal;
    
        // Save cart data and user input to the database
        $checkout = Checkout::create([
            'cart_data' => json_encode($cartData), // Store as JSON with grand_total
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'barangay' => $request->input('barangay'),
            'zip_code' => $request->input('zip_code'),
            'payment_option' => $request->input('payment_option'),
            'proof_of_payment' => $filePath,  // Store the path of the uploaded image
        ]);
    
         // Clear the cart from the session after the order is successfully stored
    session()->forget('cart'); // This clears the cart stored in the session
    
        // Redirect to the Thank You page with the order data
        return redirect()->route('thank-you', ['order' => $checkout->id]);
    }
    

    // Thank you page displaying the order summary
    public function thankYou($orderId)
    {
        // Retrieve the order details using the order ID
        $checkout = Checkout::findOrFail($orderId);

        // Pass the order data to the view
        return view('thank-you', compact('checkout'));
    }
}

