<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show the upload form
    public function showUploadForm()
    {
        // Check if the user is logged in
        $user = Auth::user();

        // If no user is logged in, redirect to the login page
        if (!$user) {
            return redirect()->route('login'); // You can change this route to your login page route
        }

        // If no profile picture is set, use the default profile picture
        if (!$user->profile_picture) {
            // Use the default profile picture if none is set
            $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg'; // Fallback default image
        }

        // Pass the user data to the view
        return view('profile.uploadprofile', compact('user'));
    }

    public function showStudentHeader()
    {
        // Get the logged-in user
        $user = Auth::user();

        // If no user is logged in, redirect to the login page
        if (!$user) {
            return redirect()->route('login'); // Adjust to match your login route
        }

        // If no profile picture is set, use the default profile picture
        if (!$user->profile_picture) {
            // Use the default profile picture if none is set
            $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg'; // Fallback default image
        }

        // Pass the user data to the view
        return view('includes.student-header', compact('user')); // Updated to student-header
    }

    public function uploadProfilePhoto(Request $request)
    {
        // Validate the request
        $request->validate([
            'cropped_profile_photo' => 'required|string',
        ]);

        // Decode the cropped image from base64
        $image = $request->input('cropped_profile_photo');
        $imageData = str_replace('data:image/jpeg;base64,', '', $image);
        $imageData = str_replace(' ', '+', $imageData);

        // Get the authenticated user
        $user = Auth::user();

        // Delete the old profile picture if it exists and is not the default
        if ($user->profile_picture && $user->profile_picture !== 'profile_photos/default.jpg') {
            $oldImagePath = storage_path('app/public/' . $user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old file
            }
        }

        // Generate a unique name for the new profile picture
        $imageName = 'profile_' . time() . '.jpg';

        // Save the new profile picture
        $newImagePath = storage_path('app/public/profile_photos/' . $imageName);
        file_put_contents($newImagePath, base64_decode($imageData));

        // Update the user's profile picture in the database
        $user->profile_picture = 'profile_photos/' . $imageName; // Store relative path
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.uploadForm')->with('success', 'Profile photo updated successfully!');
    }

    public function showAdminHeader()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login'); // Redirect to admin login
        }

        // Get the logged-in user
        $user = Auth::user();

        // Ensure only admins can access
        if (!$user->is_admin) {
            return redirect()->route('admin.login'); // Redirect if not admin
        }

        // Ensure a profile picture exists
        if (!$user->profile_picture) {
            $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg';
        }

        // Pass the user data to the view
        return view('includes.admin-header', compact('user'));
    }
}
