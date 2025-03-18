<?php
// app/Http/View/Composers/SidebarComposer.php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SidebarComposer
{
    public function compose(View $view)
    {
        // Get the logged-in user
        $user = Auth::user();

        // If no user is authenticated, use default values
        if (!$user) {
            $user = new \stdClass(); // Create a temporary object to avoid errors
            $user->profile_picture = 'profile_photos/default.jpg'; // Default image
        } else {
            // If no profile picture is set, use the default profile picture
            if (!$user->profile_picture) {
                $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg';
            }
        }

        // Share the user data with the view (e.g., 'sidebar' and 'student-header')
        $view->with('user', $user);
    }
}
