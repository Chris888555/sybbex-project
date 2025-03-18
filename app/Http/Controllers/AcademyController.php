<?php
namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    // Ensure the user is logged in before accessing any method in this controller
    public function __construct()
    {
        $this->middleware('auth');  // Redirect to login if not authenticated
    }

    // Method to fetch playlists and display them
    public function academy()
    {
        // Fetch all playlists from the database
        $playlists = Playlist::all();
        return view('academy', compact('playlists'));
    }

    // Method to handle the video view based on the title
    public function video(Request $request)
    {
        // Retrieve the title from the query string
        $playlistTitle = $request->query('tittle');  // Using the query string parameter 'tittle'

        // Find the playlist by its title
        $playlist = Playlist::where('title', $playlistTitle)->first();

        if (!$playlist) {
            // Handle case where the playlist is not found
            return redirect()->route('academy')->with('error', 'Playlist not found');
        }

        // Get the original video link from the playlist
        $video_link = $playlist->video_link;

        // ✅ Function to check if the link is a YouTube URL
        function isYouTube($url) {
            return preg_match("/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/", $url);
        }

        // ✅ Extract YouTube video ID and convert to embed URL
        function getYouTubeEmbedURL($url) {
            preg_match("/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/", $url, $matches);
            return isset($matches[1]) ? "https://www.youtube.com/embed/" . $matches[1] . "?enablejsapi=1" : "";
        }

        // ✅ Convert video link if it's a YouTube URL
        $embed_url = isYouTube($video_link) ? getYouTubeEmbedURL($video_link) : $video_link;
        $isYouTube = isYouTube($video_link);

        // Attach the embed URL (and YouTube flag) to the playlist data
        $playlist->embed_url = $embed_url;
        $playlist->is_youtube = $isYouTube;

        // Return the video view, passing the modified playlist data
        return view('video', compact('playlist'));
    }
}
