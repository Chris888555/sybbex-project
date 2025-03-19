<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesFunnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminAuthController;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');


// Footer
Route::get('/footer', function () {
    return view('includes.footer'); // <-- Dapat may 'includes.'
})->name('footer');



// Registration 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');



// Student Login 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');



// Dashboad Logout
Route::post('/logout', function () { Auth::logout(); return redirect('/login'); })->name('logout');



// Student Header
Route::get('/student-header', function () { return view('includes.student-header'); })->name('student.header');



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

Route::get('/academy', [AcademyController::class, 'academy'])->name('academy');



// Upload Playlist
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/upload-playlist', function () {
        if (auth()->user()->is_admin != 1) {
            return redirect()->route('admin.login');
        }
        return app(PlaylistController::class)->create();
    })->name('admin.upload-playlist');
});
Route::post('/admin/upload-playlist', [PlaylistController::class, 'store'])->name('playlists.store');



// Upload Products
Route::middleware(['auth'])->group(function () {
    Route::get('/upload-product', function () {
        if (auth()->user()->is_admin != 1) {
            return redirect()->route('admin.login');
        }
        return app(ProductController::class)->showUploadProduct();
    })->name('products.create');
});
Route::post('/upload-product', [ProductController::class, 'uploadProduct'])->name('products.store');
Route::post('store-brand', [ProductController::class, 'storeBrand'])->name('brands.store');



// Shop
Route::get('/shop', [ProductController::class, 'showShop'])->name('shop');



// Product Edit
Route::middleware(['auth'])->group(function () {
    Route::get('/product-edit', function () {
        if (auth()->user()->is_admin != 1) {
            return redirect()->route('admin.login');
        }
        return app(ProductController::class)->showEditProduct();
    })->name('product.edit');
});
Route::put('/product/{id}', [ProductController::class, 'updateProduct'])->name('product.update');



// Check Out
Route::get('/checkout', [CheckoutController::class, 'view'])->name('checkout.view');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/thank-you/{order}', [CheckoutController::class, 'thankYou'])->name('thank-you');



// Order Details
Route::get('/order-details', [OrderController::class, 'orderShow'])->name('order.details');
Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');



// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'checkEmail'])->name('password.check');
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');



// User Profile 
Route::middleware(['auth'])->get('profile/upload', [ProfileController::class, 'showUploadForm'])->name('profile.uploadForm');
Route::middleware(['auth'])->post('profile/upload', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.upload');


// Sales Funnel Setting
Route::middleware(['auth'])->get('/funnel-main', function () {
    $users = User::all();
    return view('funnel-main', compact('users'));
})->name('funnel.main');


// Admin Manage Users
Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
Route::post('/users/{user}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
Route::delete('/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('users.delete');
Route::post('/users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promoteToAdmin');
Route::post('/users/revert-to-regular/{user}', [AdminController::class, 'revertToRegular'])->name('admin.revertToRegular');


// Admin Login
Route::get('/admin/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/admin-login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('auth');


// Subdomain 
Route::get('/{subdomain}', [SalesFunnelController::class, 'showFunnel']);


// Edit Subdomain
Route::middleware(['auth'])->get('/subdomain/update/{id}', [SalesFunnelController::class, 'editSubdomain'])->name('update.subdomain');
Route::middleware(['auth'])->post('/subdomain/update/{id}', [SalesFunnelController::class, 'updateSubdomain'])->name('update.subdomain');