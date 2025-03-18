<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;

class ProductController extends Controller
{
    public function showUploadProduct()
    {
        return view('product-upload'); // Ensure this view exists in resources/views/
    }

    public function uploadProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'shipping_fee' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Image and get relative path (inside storage/app/public/shop_image)
        $imagePath = $request->file('image')->store('shop_image', 'public');

        // Log Image Path for debugging
        Log::info('Uploaded Image Path: ' . $imagePath);

        // Create and Save Product
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->shipping_fee = $request->shipping_fee;
        $product->category = $request->category;
        $product->image_path = $imagePath; // Only save the relative path

        // Log Data before saving
        Log::info('Saving Product Data:', $product->toArray());

        $product->save();

        return redirect()->back()->with('success', 'Product uploaded successfully!');
    }


// For Store Brand Name
    public function storeBrand(Request $request)
    {
        // Validate the brand name
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
    
        // Save the brand name in the database
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Brand submitted successfully!');
    }
    

   // For fetch Data

   public function showShop()
{
    $products = Product::all(); // Fetch all products
    $brands = Brand::all(); // Fetch all brands (plural)

    return view('shop', compact('products', 'brands')); // Pass both products and brands to the view
}

}