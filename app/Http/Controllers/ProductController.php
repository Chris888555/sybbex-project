<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Display the Upload Product Form and List Products
    public function showUploadProduct()
    {
        $products = Product::all();  // Fetch all products from the database
        return view('product-upload', compact('products'));  // Pass products to the view
    }

    // Handle the Upload of a Product
    public function uploadProduct(Request $request)
    {
        // Validate the product data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100', // Make category optional
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'shipping_rules' => 'required|json', // Ensure shipping_rules is valid JSON
            'weight' => 'nullable|numeric|min:0', // Make weight nullable
        ]);
    
        // Assign default weight of 500 if it's not provided
        $weight = $request->has('weight') ? $request->weight : 500;
    
        // Upload Image and get relative path
        $imagePath = $request->file('image')->store('shop_image', 'public');
        
        // Log Image Path for debugging
        Log::info('Uploaded Image Path: ' . $imagePath);
    
        // Create and save the product in the database
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category; // Category is now optional
        $product->image_path = $imagePath;
        $product->shipping_rules = json_decode($request->shipping_rules, true); // Convert JSON string to array
        $product->weight = $weight; // Save the weight (either provided or default 500)
    
        // Save the product data
        $product->save();
    
        return redirect()->back()->with('success', 'Product uploaded successfully!');
    }
    

    // Store Brand Name
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
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Brand submitted successfully!');
    }


    // Display the Shop with All Products and Brands
    public function showShop()
    {
        $products = Product::all();  // Fetch all products
        $brands = Brand::all();  // Fetch all brands
        return view('shop', compact('products', 'brands'));  // Pass data to the view
    }






// Delete Product by ID **********************************************************

public function destroy($id)
{
    // Find product by ID and delete
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('upload.product')->with('success', 'Product deleted successfully!');
}


// Display the Edit Product Form
public function showEditProduct()
{
    $products = Product::all();  // Retrieve the first product
    return view('product-edit', compact('products'));  // Pass the product data to the view
}

public function updateProduct(Request $request, $id)
{
    // Validate the product data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string|max:100',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'shipping_rules' => 'required|json',
        'weight' => 'nullable|numeric|min:0',
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Update the product fields
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category = $request->category;
    $product->weight = $request->has('weight') ? $request->weight : 500;
    $product->shipping_rules = json_decode($request->shipping_rules, true);

    // If a new image is uploaded, delete the old image and update with the new one
    if ($request->hasFile('image')) {
        // Delete the old image if it exists in the 'shop_image' directory
        if ($product->image_path) {
            // Construct the full path to the old image
            $oldImagePath = storage_path('app/public/' . $product->image_path);
            
            // Check if the old image exists and delete it
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old image file
            }
        }

        // Store the new image and update the product's image path
        $imagePath = $request->file('image')->store('shop_image', 'public');
        $product->image_path = $imagePath;
    }

    // Save the updated product
    $product->save();

    return redirect()->route('product.edit')->with('success', 'Product updated successfully!');
}


}
