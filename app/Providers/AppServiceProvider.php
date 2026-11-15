<?php

namespace App\Providers;

use App\Models\Booking;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.admin', 'layouts.superadmin'], function ($view) {
            try {
                if (Schema::hasTable('bookings')) {
                    $recentBookings = Booking::with('trip')
                        ->latest()
                        ->take(7)
                        ->get();

                    $unreadCount = Schema::hasColumn('bookings', 'is_read')
                        ? Booking::where('is_read', false)->count()
                        : Booking::where('status', 'pending')->count();

                    $view->with([
                        'notificationBookings' => $recentBookings,
                        'unreadBookingsCount' => $unreadCount,
                    ]);
                }
            } catch (\Throwable $e) {
                $view->with([
                    'notificationBookings' => collect(),
                    'unreadBookingsCount' => 0,
                ]);
            }
        });
    }
}
