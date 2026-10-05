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
    Route::get('/trips', [AdminController::class, 'trips'])->name('trips');
    Route::get('/schedule', [AdminController::class, 'schedule'])->name('schedule');
    Route::get('/participants', [AdminController::class, 'participants'])->name('participants');
    Route::get('/booking', [AdminController::class, 'booking'])->name('booking');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});


// Superadmin Dashboard Routes
Route::middleware(['auth', \App\Http\Middleware\CheckSuperadmin::class])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\SuperadminController::class, 'dashboard'])->name('dashboard');
    Route::get('/content', [\App\Http\Controllers\SuperadminController::class, 'content'])->name('content');
    Route::get('/news', [\App\Http\Controllers\SuperadminController::class, 'news'])->name('news');
    Route::get('/articles', [\App\Http\Controllers\SuperadminController::class, 'articles'])->name('articles');
    Route::get('/mountains', [\App\Http\Controllers\SuperadminController::class, 'mountains'])->name('mountains');
    Route::get('/trip', [\App\Http\Controllers\SuperadminController::class, 'trip'])->name('trip');
    Route::get('/booking', [\App\Http\Controllers\SuperadminController::class, 'booking'])->name('booking');
    Route::get('/payment', [\App\Http\Controllers\SuperadminController::class, 'payment'])->name('payment');
    Route::get('/community', [\App\Http\Controllers\SuperadminController::class, 'community'])->name('community');
    Route::get('/points', [\App\Http\Controllers\SuperadminController::class, 'points'])->name('points');
    Route::get('/rewards', [\App\Http\Controllers\SuperadminController::class, 'rewards'])->name('rewards');
    Route::get('/reports', [\App\Http\Controllers\SuperadminController::class, 'reports'])->name('reports');
});
