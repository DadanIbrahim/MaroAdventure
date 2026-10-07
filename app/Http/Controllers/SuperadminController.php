<?php

namespace App\Http\Controllers;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function users()
    {
        return view('superadmin.users');
    }

    public function content()
    {
        return view('superadmin.content');
    }

}
