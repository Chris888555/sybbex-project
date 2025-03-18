<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    // Ensure only authenticated users can upload playlists
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the form to create a new playlist
    public function create()
    {
        return view('admin.upload-playlist');
    }

    // Store the playlist
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|max:255',
            'video_link' => 'required|url', // Validate that it's a valid URL (YouTube link or MP4)
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate thumbnail (optional)
        ]);

        // Handle the thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            // Store the image in the 'thumbnails' folder inside the public storage directory
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Store the playlist in the database
        Playlist::create([
            'title' => $request->title,
            'video_link' => $request->video_link,
            'thumbnail_url' => $thumbnailPath, // Save the path to the image
        ]);

        // Redirect back to the upload playlist page with a success message
        return redirect()->route('admin.upload-playlist')->with('success', 'Playlist uploaded successfully!');
    }
}
