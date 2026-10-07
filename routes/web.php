<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Artikel & Berita
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

// Autentikasi (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Google OAuth
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// Dashboard & Checkout (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
    Route::get('/dashboard/bookings/{id}', [DashboardController::class, 'showBooking'])->name('dashboard.bookings.show');
    Route::get('/dashboard/points', [DashboardController::class, 'points'])->name('dashboard.points');
    Route::get('/dashboard/community', [DashboardController::class, 'community'])->name('dashboard.community');
    Route::post('/dashboard/community', [DashboardController::class, 'storeCommunity'])->name('dashboard.community.store');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');

    // Checkout Flow
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Admin Setup Route (Temporary)
Route::get('/setup-admin', function () {
    User::updateOrCreate(
        ['email' => 'admin123@maroadventure.com'],
        [
            'name' => 'Administrator',
            'password' => bcrypt('12345678'),
        ]
    );

    return 'Admin user created successfully! You can now login with email: <b>admin123@maroadventure.com</b> and password: <b>12345678</b>';
});

// Admin Dashboard Routes
Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/content', [AdminController::class, 'content'])->name('content');
    Route::resource('articles', \App\Http\Controllers\BackendArticleController::class);
    Route::resource('mountains', \App\Http\Controllers\MountainController::class);
    Route::resource('trips', \App\Http\Controllers\TripController::class);
    Route::resource('booking', \App\Http\Controllers\BookingController::class)->names('bookings');
    Route::resource('payment', \App\Http\Controllers\PaymentController::class)->names('payments');
    Route::resource('community', \App\Http\Controllers\BackendCommunityController::class)->only(['index', 'destroy']);
    Route::resource('points', \App\Http\Controllers\PointController::class)->only(['index', 'edit', 'update']);
    Route::resource('rewards', \App\Http\Controllers\RewardController::class);
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports');
});


// Superadmin Dashboard Routes
Route::middleware(['auth', \App\Http\Middleware\CheckSuperadmin::class])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\SuperadminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\SuperadminController::class, 'users'])->name('users'); // User Management
    Route::get('/content', [\App\Http\Controllers\SuperadminController::class, 'content'])->name('content');
    Route::resource('articles', \App\Http\Controllers\BackendArticleController::class);
    Route::resource('mountains', \App\Http\Controllers\MountainController::class);
    Route::resource('trips', \App\Http\Controllers\TripController::class);
    Route::resource('booking', \App\Http\Controllers\BookingController::class)->names('bookings');
    Route::resource('payment', \App\Http\Controllers\PaymentController::class)->names('payments');
    Route::resource('community', \App\Http\Controllers\BackendCommunityController::class)->only(['index', 'destroy']);
    Route::resource('points', \App\Http\Controllers\PointController::class)->only(['index', 'edit', 'update']);
    Route::resource('rewards', \App\Http\Controllers\RewardController::class);
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports');
});
