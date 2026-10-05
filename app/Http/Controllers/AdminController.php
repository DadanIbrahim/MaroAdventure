<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function trips()
    {
        return view('admin.trips');
    }

    public function schedule()
    {
        return view('admin.schedule');
    }

    public function participants()
    {
        return view('admin.participants');
    }

    public function booking()
    {
        return view('admin.booking');
    }

    public function reports()
    {
        return view('admin.reports');
    }
}
