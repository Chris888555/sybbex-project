<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminHeaderComposer
{
    public function compose(View $view)
    {
        // Get the logged-in user
        $user = Auth::user();

        // Ensure the user has a profile picture, otherwise set a default one
        if ($user && !$user->profile_picture) {
            $user->profile_picture = $user->default_profile ?? 'profile_photos/default.jpg';
        }

        // Share the user data with the 'admin-header' view
        $view->with('user', $user);
    }
}
