<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Trip;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Total Net Profit from paid bookings
        $totalProfit = Booking::where('payment_status', 'paid')->sum('total_price');
        
        // Count total successful bookings
        $totalBookings = Booking::where('payment_status', 'paid')->count();
        
        // Count active users
        $totalUsers = User::count();
        
        // Count trips available
        $totalTrips = Trip::count();

        // Get latest paid bookings as "activity logs"
        $recentBookings = Booking::with('user', 'trip')
                            ->where('payment_status', 'paid')
                            ->latest('updated_at')
                            ->take(10)
                            ->get();

        return view('superadmin.reports', compact(
            'totalProfit', 
            'totalBookings', 
            'totalUsers', 
            'totalTrips',
            'recentBookings'
        ));
    }
}

