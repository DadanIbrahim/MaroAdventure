<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function content()
    {
        return view('superadmin.content');
    }

}
