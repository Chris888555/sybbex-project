<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show all users (approved or pending based on the query parameter)
    public function manageUsers(Request $request)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('admin.login');
        }

        $view = $request->get('view', 'approved'); // Default to 'approved'
        $search = $request->get('search', ''); // Get search query
    
        // Get the total counts for approved and pending users
        $totalApprovedUsers = User::where('approved', 1)
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->count();
    
        $totalPendingUsers = User::where('approved', 0)
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->count();
    
        // Paginate the users based on their approval status and search criteria
        if ($view == 'approved') {
            $users = User::where('approved', 1)
                ->where(function($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('email', 'like', "%$search%");
                })
                ->paginate(10); // Paginate 10 approved users per page
        } else {
            $users = User::where('approved', 0)
                ->where(function($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('email', 'like', "%$search%");
                })
                ->paginate(10); // Paginate 10 pending users per page
        }
    
        // Appending the view and search parameter to maintain filtering when navigating between pages
        return view('admin.manage-users', compact('users', 'view', 'search', 'totalApprovedUsers', 'totalPendingUsers'));
    }

    // Approve User (for pending users)
    public function approveUser(User $user)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('admin.login');
        }

        $user->approved = 1; // Set to approved
        $user->save();

        return redirect()->route('admin.manage-users', [
            'view' => 'approved', 
            'search' => request('search')  // Keep the search parameter
        ])->with('success', 'User approved successfully!');
    }

    // Delete User
    public function deleteUser(User $user)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('admin.login');
        }
    
        // Delete the profile picture if it exists and is not the default one
        if ($user->profile_picture && $user->profile_picture !== 'profile_photos/default.jpg') {
            $profilePicPath = storage_path('app/public/' . $user->profile_picture); // Get full path
            if (file_exists($profilePicPath)) {
                unlink($profilePicPath); // Delete the profile picture
            }
        }
    
        // Delete the default profile picture if it exists and is not the default one
        if ($user->default_profile && $user->default_profile !== 'profile_photos/default.jpg') {
            $defaultProfilePath = storage_path('app/public/' . $user->default_profile); // Get full path
            if (file_exists($defaultProfilePath)) {
                unlink($defaultProfilePath); // Delete the default profile picture
            }
        }
    
        // Now delete the user from the database
        $user->delete();
    
        return redirect()->route('admin.manage-users', [
            'view' => request('view'),  // Keep the current view
            'search' => request('search')  // Keep the search parameter
        ])->with('success', 'User deleted successfully!');
    }
    

    // Promote User to Admin
    public function promoteToAdmin(User $user)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('admin.login');
        }

        $user->is_admin = 1; // Promote to admin
        $user->save();

        return redirect()->route('admin.manage-users', [
            'view' => request('view'),  // Keep the current view
            'search' => request('search')  // Keep the search parameter
        ])->with('success', 'User promoted to admin successfully!');
    }

    // Revert User to Regular User (for admins)
    public function revertToRegular(User $user)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('admin.login');
        }

        // Only revert if the user is an admin
        if ($user->is_admin) {
            $user->is_admin = 0; // Revert to regular user
            $user->save();
            return redirect()->route('admin.manage-users', [
                'view' => request('view'),  // Keep the current view
                'search' => request('search')  // Keep the search parameter
            ])->with('success', 'User reverted to regular user successfully!');
        }

        return redirect()->route('admin.manage-users', [
            'view' => request('view'),  // Keep the current view
            'search' => request('search')  // Keep the search parameter
        ])->with('error', 'User is already a regular user.');
    }
}
