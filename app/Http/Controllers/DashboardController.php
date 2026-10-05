<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function bookings()
    {
        return view('dashboard.bookings');
    }

    public function showBooking($id)
    {
        return view('dashboard.booking_detail', compact('id'));
    }

    public function points()
    {
        return view('dashboard.points');
    }

    public function community()
    {
        return view('dashboard.community');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}
