<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Import Str for random generation

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister(Request $request)
    {
        // Get the referral code from the URL
        $referralCode = $request->query('ref'); // Extract referral code (use 'ref' from URL)

        // Pass the referral code to the view (you can use it in the registration form)
        return view('auth.register', compact('referralCode')); // Return register view with referralCode
    }

    public function register(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            ],
            'password' => [
                'required',
                'string',
                'min:3',
                'confirmed',
            ],
        ], [
            'email.regex' => 'Only @gmail.com emails are allowed.',
            'password.min' => 'Password must be at least 3 characters long.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        // Extract subdomain from email
        $subdomain = str_replace('.', '', explode('@', $request->email)[0]);

        // Ensure unique subdomain
        $originalSubdomain = $subdomain;
        $counter = 1;
        while (User::where('subdomain', $subdomain)->exists()) {
            $subdomain = $originalSubdomain . $counter;
            $counter++;
        }

        // Default profile image
        $defaultProfileUrl = 'https://tse1.mm.bing.net/th?id=OIP.lcdOc6CAIpbvYx3XHfoJ0gHaF3&pid=Api&P=0&h=220';
        $imageContents = file_get_contents($defaultProfileUrl);
        $imageName = 'profile_' . time() . '.jpg';
        $path = storage_path('app/public/profile_photos/' . $imageName);
        file_put_contents($path, $imageContents);
        $imagePath = 'profile_photos/' . $imageName;

        // Get the referral code from the input (passed as a hidden field)
        $referralCode = $request->input('referral_code');
        $referrer = null;

        // If a referral code exists, find the user who referred
        if ($referralCode) {
            $referrer = User::where('referral_code', $referralCode)->first();
        }

        // Generate a random referral code for the new user
        $generatedReferralCode = Str::random(8); // 8-character random referral code

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'subdomain' => $subdomain,
            'is_admin' => 0,
            'approved' => 0,
            'default_profile' => $imagePath,
            'is_online' => 0,
            'referral_code' => $generatedReferralCode,
            'referred_by' => $referrer ? $referrer->id : null, // Link the user to the referrer if there is one
        ]);

        return back()->with('success', 'Registration successful!');
    }



    
    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['error' => 'Invalid email or password']);
    }

    // Convert `approved` to integer manually
    $user->approved = (int) $user->approved;

    if ((int)$user->approved !== 1) { // Convert manually to integer
        return back()->withErrors(['error' => 'Your account is not approved yet.']);
    }
    

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['error' => 'Invalid email or password']);
}

    


    // Logout (No Redirection)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back();
    }

    // Check if email exists
    // Check if email exists
public function checkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not found']);
    }

    // Pass email to the reset password view
    return view('auth.reset-password', ['email' => $request->email]);
}

// Reset Password
public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:3|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    // Check if user exists, just to be safe
    if (!$user) {
        return back()->withErrors(['email' => 'Invalid email address']);
    }

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('status', 'Password successfully updated.');
}

}
