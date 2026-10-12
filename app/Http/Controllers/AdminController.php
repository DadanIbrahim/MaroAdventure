<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_price');
        $totalTrips = Trip::count();
        $totalParticipants = User::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $recentBookings = Booking::with(['user', 'trip'])->latest()->take(5)->get();
        $popularTrips = Trip::withCount('bookings')->orderByDesc('bookings_count')->take(4)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalTrips',
            'totalParticipants',
            'pendingBookings',
            'recentBookings',
            'popularTrips'
        ));
    }

    public function content()
    {
        return view('superadmin.content');
    }

    public function participants(Request $request)
    {
        $search = $request->input('search');

        $query = User::withCount('bookings')
            ->with(['bookings.trip']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $participants = $query->latest()->paginate(10)->withQueryString();

        $totalUsers = User::count();
        $totalTravelers = User::has('bookings')->count();
        $totalBookings = Booking::count();
        $totalPoints = User::sum('points');

        return view('admin.participants', compact(
            'participants',
            'totalUsers',
            'totalTravelers',
            'totalBookings',
            'totalPoints',
            'search'
        ));
    }
}
