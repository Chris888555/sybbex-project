<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MonitorClientController;



// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');


// Footer
Route::get('/footer', function () {
    return view('includes.footer'); // <-- Dapat may 'includes.'
})->name('footer');

// Nav Bar
Route::get('/nav', function () {
    return view('includes.nav'); // <-- Dapat may 'includes.'
})->name('nav');


// Registration 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');



// Student Login 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');



// Dashboad Logout
Route::post('/logout', function () { Auth::logout(); return redirect('/login'); })->name('logout');


// Admin Manage Users
Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
Route::post('/users/{user}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
Route::delete('/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('users.delete');
Route::post('/users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promoteToAdmin');
Route::post('/users/revert-to-regular/{user}', [AdminController::class, 'revertToRegular'])->name('admin.revertToRegular');
Route::post('/users/{user}/revert-to-pending', [AdminController::class, 'revertToPending'])->name('users.revertToPending');



// Dashboard
Route::get('/dashboard', function () {
    // Check if the user is authenticated
    if (!Auth::check()) {
        // If not authenticated, redirect to login page
        return redirect()->route('login');
    }
    // If authenticated, return the dashboard view
    return view('dashboard');
})->name('dashboard');

// User Profile 
Route::middleware(['auth'])->get('profile/upload', [ProfileController::class, 'showUploadForm'])->name('profile.uploadForm');
Route::middleware(['auth'])->post('profile/upload', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.upload');


// Create Pages
Route::middleware(['auth'])->group(function () {
    Route::get('/create-landing-page', [LandingPageController::class, 'showCreatePageForm'])->name('create-landing-page');
    Route::post('/create-landing-page', [LandingPageController::class, 'createPage'])->name('landing-page.create');
});

// Update subdomain
Route::get('/{subdomain}/{page_id}', [LandingPageController::class, 'showPage'])->name('showPage');
Route::post('/{subdomain}/{page_id}', [LandingPageController::class, 'submitForm'])->name('submit.form');


// Update Landing and Funnel Pages
Route::get('update-page', [LandingPageController::class, 'showEditPageForm'])->name('landing.update-page');
Route::put('update-landing-page/{id}', [LandingPageController::class, 'updateLandingPage'])->name('landing.update-landing-page');
Route::put('update-sales-funnel/{id}', [LandingPageController::class, 'updateSalesFunnel'])->name('sales-funnel.update');
Route::delete('/landing/{id}/delete', [LandingPageController::class, 'delete'])->name('landing.delete');


// Monitor Clients
Route::get('/mysignup', [MonitorClientController::class, 'index'])->name('monitor.mysignup');
Route::get('/users/{userId}/clients', [MonitorClientController::class, 'getClients']);

// Export Emails
Route::get('/admin/clients/export', [MonitorClientController::class, 'exportClients'])->name('clients.export');





// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'checkEmail'])->name('password.check');
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');




// Admin Login
Route::get('/admin/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/admin-login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('auth');



// Edit Subdomain
Route::middleware(['auth'])->get('/subdomain/update/{id}', [SalesFunnelController::class, 'editSubdomain'])->name('update.subdomain');
Route::middleware(['auth'])->post('/subdomain/update/{id}', [SalesFunnelController::class, 'updateSubdomain'])->name('update.subdomain');


// Subdomain 
Route::get('/{subdomain}', [SalesFunnelController::class, 'showFunnel']);



