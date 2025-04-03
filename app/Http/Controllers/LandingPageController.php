<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Models\SalesFunnelPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;



class LandingPageController extends Controller
{
    // Show the landing page creation form
    public function showCreatePageForm()
    {
        // Fetch all landing pages for all users
        $pages = LandingPage::all(); // Retrieve all landing pages from the database
    
        return view('landing.create-landing-page', compact('pages'));
    }
    

    // Handle Landing Page Creation
    public function createPage(Request $request)
    {
        // Validate input
        $request->validate([
            'landing_title' => 'required|string|max:255',
            'funnel_title' => 'required|string|max:255',
            'property_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for property image
            'floor_images' => 'nullable|array', // Allow an array of images for floor images
            'floor_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each floor image
        ]);
        
        // Ensure the directory exists
        Storage::disk('public')->makeDirectory('myuploads');
        
        // Handle Property Image Upload
        if ($request->hasFile('property_image')) {
            $propertyImage = $request->file('property_image');
            $propertyImagePath = 'myuploads/' . $propertyImage->getClientOriginalName();
            $propertyImage->storeAs('public/myuploads', $propertyImage->getClientOriginalName());
        } else {
            // Default image URL if no custom upload
            $defaultImageName = 'wp3017043.jpg'; // Default image name
            $propertyImagePath = 'myuploads/' . $defaultImageName;
            
            // Fetch and store the default property image from the lot-image folder to myuploads
            $defaultImage = public_path('storage/lot-image/' . $defaultImageName); // Path of the default property image
            $defaultImageStored = Storage::disk('public')->put('myuploads/' . $defaultImageName, file_get_contents($defaultImage));
    
            // If storing default image failed
            if (!$defaultImageStored) {
                return back()->with('error', 'Error storing default property image.');
            }
        }
    
        // Handle Multiple Floor Image Uploads
        $floorImagesPaths = [];
        if ($request->hasFile('floor_images')) {
            foreach ($request->file('floor_images') as $floorImage) {
                $floorImagePath = 'myuploads/' . $floorImage->getClientOriginalName();
                $floorImage->storeAs('public/myuploads', $floorImage->getClientOriginalName());
                $floorImagesPaths[] = asset('storage/' . $floorImagePath); // Store image path in array
            }
        } else {
            // Default floor image if no custom upload
            $defaultFloorImageName = 'basement-floor-plans.jpg'; // Default floor image name
            $floorImagesPaths[] = 'myuploads/' . $defaultFloorImageName;
            
            // Fetch and store the default floor image from the lot-image folder to myuploads
            $defaultFloorImage = public_path('storage/lot-image/' . $defaultFloorImageName); // Path of the default floor image
            $defaultFloorImageStored = Storage::disk('public')->put('myuploads/' . $defaultFloorImageName, file_get_contents($defaultFloorImage));
    
            // If storing default floor image failed
            if (!$defaultFloorImageStored) {
                return back()->with('error', 'Error storing default floor image.');
            }
        }
    
        // Create Landing Page
        $landingPage = LandingPage::create([
            'page_id' => bin2hex(random_bytes(5)),
            'landing_title' => $request->landing_title,
            'landing_content' => json_encode([
                'headline' => 'Exclusive Lots for Sale in Prime Locations',
                'subheadline' => 'Take advantage of competitive prices and start your journey toward property ownership today.',
            ]),
        ]);
    
        // Create Sales Funnel Content with Multiple Floor Images
        $defaultFunnelContent = json_encode([
            'headline' => 'Struggling to Find the Perfect Lot? Don’t Miss Out',
            'subheadline' => 'Opportunities like this are rare. Secure your ideal lot now before it’s gone — perfect for your future home or investment.',
            'video_link' => 'https://www.youtube.com/embed/d6J5oAnOvs8',
            'property_image' => asset('storage/' . $propertyImagePath), // Use the uploaded or default property image path
            'floor_images' => array_map(function ($path) {
                return asset('storage/' . $path); // Ensure correct format for each floor image path
            }, $floorImagesPaths),
            'chat_group_link' => 'https://your-group-chat-link',
        ]);
    
        // Save Sales Funnel Page
        SalesFunnelPage::create([
            'landing_page_id' => $landingPage->id,
            'page_id' => bin2hex(random_bytes(5)),
            'funnel_title' => $request->funnel_title,
            'funnel_content' => $defaultFunnelContent,
        ]);
    
        return redirect()->route('create-landing-page')->with('success', 'Landing Page Created Successfully!');
    }
    
    




    // Show page ito
    public function showPage($subdomain, $page_id)
{
    // Fetch the LandingPage by page_id (across all users)
    $landingPage = LandingPage::where('page_id', $page_id)->first();

    // Fetch the SalesFunnelPage by page_id (across all users)
    $funnelPage = SalesFunnelPage::where('page_id', $page_id)->first();

    // Check which page to associate the client with
    if ($landingPage) {
        // If LandingPage is found, show the landing page
        return view('landing.showLandingPage', compact('landingPage', 'subdomain'));
    } elseif ($funnelPage) {
        // If SalesFunnelPage is found, show the sales funnel page
        return view('landing.showSalesFunnel', compact('funnelPage', 'subdomain'));
    } else {
        // If no page is found, return a 404 error or custom message
        abort(404, 'Page not found.');
    }
}




public function submitForm(Request $request, $subdomain, $page_id)
{
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
    ]);

    // Find the user by subdomain from the users table
    $user = User::where('subdomain', $subdomain)->first();
    if (!$user) {
        return redirect()->back()->with('error', 'User not found for this subdomain.');
    }

    // Find the LandingPage based on page_id
    $landingPage = LandingPage::where('page_id', $page_id)->first();
    if (!$landingPage) {
        return redirect()->back()->with('error', 'Landing Page not found.');
    }

    // Save the client data to the client table for the landing page
    $client = Client::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'user_id' => $user->id,  // Associate user_id from the users table
        'page_id' => $landingPage->page_id,  // Associate client with the landing page
    ]);

    // Find the corresponding SalesFunnelPage that has the matching landing_page_id
    $funnelPage = SalesFunnelPage::where('landing_page_id', $landingPage->id)->first();

    if (!$funnelPage) {
        return redirect()->back()->with('error', 'No matching sales funnel page found.');
    }

    // Redirect to the matching SalesFunnelPage
    $redirectUrl = url("/{$subdomain}/{$funnelPage->page_id}");

    // Redirect to the funnel page
    return redirect($redirectUrl)->with('success', 'Your information has been submitted successfully!');
}









public function showEditPageForm()
{
    // Fetch all landing pages (this will return a collection)
    $landingPages = LandingPage::all(); 
    $SalesFunnelPages = SalesFunnelPage::all(); 

    // Return the view with all landing pages
    return view('landing.update-page', compact('landingPages', 'SalesFunnelPages'));
}

public function updateLandingPage(Request $request, $id)
{
    // Validate incoming request for landing page
    $request->validate([
        'landing_title' => 'nullable|string|max:255', 
        'headline' => 'nullable|string',                
        'subheadline' => 'nullable|string',             
        'page_id' => 'nullable|string|max:255',
    ]);

    $landingPage = LandingPage::find($id);
    if (!$landingPage) {
        return redirect()->route('landing.update-page')->with('error', 'Landing page not found!');
    }

    // Decode the existing landing_content
    $landingContent = json_decode($landingPage->landing_content, true);

    // Update landing page
    $landingPage->update([
        'landing_title' => $request->landing_title ?? $landingPage->landing_title,
        'landing_content' => json_encode([
            'headline' => $request->headline ?? $landingContent['headline'] ?? '',
            'subheadline' => $request->subheadline ?? $landingContent['subheadline'] ?? '',
        ]),
        'page_id' => $request->page_id ?? $landingPage->page_id,
    ]);

    return redirect()->route('landing.update-page')->with('success', 'Landing page updated successfully!');
}

public function updateSalesFunnel(Request $request, $id)
{
    // Validate incoming request for sales funnel
    $request->validate([
        'funnel_title' => 'nullable|string',
        'funnel_headline' => 'nullable|string',
        'funnel_subheadline' => 'nullable|string',
        'video_link' => 'nullable|string',
        'chat_group_link' => 'nullable|string',
        'property_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        'floor_images' => 'nullable|array',
        'floor_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        'page_id' => 'nullable|string|max:255', // Page ID validation
    ]);

    // Find the Sales Funnel Page by ID
    $salesFunnel = SalesFunnelPage::find($id);
    if (!$salesFunnel) {
        return redirect()->route('landing.update-page')->with('error', 'Sales funnel page not found!');
    }

    // Decode the existing funnel content
    $updatedFunnelContent = json_decode($salesFunnel->funnel_content, true);

    // Update funnel content with new data
    $updatedFunnelContent['headline'] = $request->funnel_headline ?? $updatedFunnelContent['headline'];
    $updatedFunnelContent['subheadline'] = $request->funnel_subheadline ?? $updatedFunnelContent['subheadline'];
    $updatedFunnelContent['video_link'] = $request->video_link ?? $updatedFunnelContent['video_link'];
    $updatedFunnelContent['chat_group_link'] = $request->chat_group_link ?? $updatedFunnelContent['chat_group_link'];

  // Handle Property Image Upload
if ($request->hasFile('property_image')) {
    // Check if there's an existing property image and delete it
    if (isset($updatedFunnelContent['property_image'])) {
        // Get the old image path and delete it from storage
        $oldImagePath = str_replace(asset('storage/'), '', $updatedFunnelContent['property_image']);
        Storage::disk('public')->delete($oldImagePath); // Delete the old image
    }

    // Store the new uploaded property image in the 'myuploads' directory
    $propertyImagePath = $request->file('property_image')->store('myuploads', 'public');
    $updatedFunnelContent['property_image'] = asset('storage/' . $propertyImagePath);
}

// Handle Floor Images Upload
if ($request->hasFile('floor_images')) {
    $floorImagesPaths = [];

    // Loop through the uploaded floor images
    foreach ($request->file('floor_images') as $floorImage) {
        // Check if there is an existing floor image and delete it
        if (isset($updatedFunnelContent['floor_images'])) {
            foreach ($updatedFunnelContent['floor_images'] as $existingFloorImage) {
                // Get the old image path and delete it from storage
                $oldFloorImagePath = str_replace(asset('storage/'), '', $existingFloorImage);
                Storage::disk('public')->delete($oldFloorImagePath); // Delete the old floor image
            }
        }

        // Store the new uploaded floor image in the 'myuploads' directory
        $floorImagePath = $floorImage->store('myuploads', 'public');
        $floorImagesPaths[] = asset('storage/' . $floorImagePath); // Add the new image path to the array
    }

    // Update the floor images in the funnel content
    $updatedFunnelContent['floor_images'] = $floorImagesPaths;
}



    // Update SalesFunnelPage with new data including the page_id
    $salesFunnel->update([
        'funnel_title' => $request->funnel_title ?? $salesFunnel->funnel_title,
        'funnel_content' => json_encode($updatedFunnelContent),
        'page_id' => $request->page_id ?? $salesFunnel->page_id, // Update page_id if provided
    ]);

    return redirect()->route('landing.update-page')->with('success', 'Sales funnel updated successfully!');
}

public function delete($id)
{
    // Find the landing page by its ID
    $landingPage = LandingPage::findOrFail($id);

    // Find the associated sales funnel page
    $salesFunnelPage = $landingPage->salesFunnelPages->first();

    // Delete the sales funnel page if it exists
    if ($salesFunnelPage) {
        $salesFunnelPage->delete();
    }

    // Delete the landing page
    $landingPage->delete();

    // Redirect back with success message
    return redirect()->route('landing.update-page')->with('success', 'Landing page and associated funnel deleted successfully!');
}

}

