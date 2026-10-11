<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackendArticleController;
use App\Http\Controllers\BackendCommunityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MountainController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PublicTripController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TripController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckSuperadmin;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Fallback untuk melayani file storage gambar jika symlink Windows belum aktif
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/'.$path);
    if (! file_exists($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
})->where('path', '.*');

// Paket Perjalanan (Publik)
Route::get('/trips', [PublicTripController::class, 'index'])->name('trips.index');
Route::get('/trips/{trip}', [PublicTripController::class, 'show'])->name('trips.show');

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
    Route::post('/dashboard/points/redeem', [DashboardController::class, 'redeemReward'])->name('dashboard.points.redeem');
    Route::get('/dashboard/community', [DashboardController::class, 'community'])->name('dashboard.community');
    Route::post('/dashboard/community', [DashboardController::class, 'storeCommunity'])->name('dashboard.community.store');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::put('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::put('/dashboard/profile/password', [DashboardController::class, 'updatePassword'])->name('dashboard.profile.password');

    // Checkout Flow
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
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
Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/content', [AdminController::class, 'content'])->name('content');
    Route::resource('articles', BackendArticleController::class);
    Route::resource('mountains', MountainController::class);
    Route::resource('trips', TripController::class);
    Route::resource('booking', BookingController::class)->names('bookings');
    Route::resource('payment', PaymentController::class)->names('payments');
    Route::resource('community', BackendCommunityController::class)->only(['index', 'destroy']);
    Route::resource('points', PointController::class)->only(['index', 'edit', 'update']);
    Route::resource('rewards', RewardController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});

// Superadmin Dashboard Routes
Route::middleware(['auth', CheckSuperadmin::class])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperadminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [SuperadminController::class, 'users'])->name('users'); // User Management
    Route::post('/users', [SuperadminController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{user}', [SuperadminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [SuperadminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/content', [SuperadminController::class, 'content'])->name('content');
    Route::resource('articles', BackendArticleController::class);
    Route::resource('mountains', MountainController::class);
    Route::resource('trips', TripController::class);
    Route::resource('booking', BookingController::class)->names('bookings');
    Route::resource('payment', PaymentController::class)->names('payments');
    Route::resource('community', BackendCommunityController::class)->only(['index', 'destroy']);
    Route::resource('points', PointController::class)->only(['index', 'edit', 'update']);
    Route::resource('rewards', RewardController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});
