<?php

namespace App\Http\Controllers;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function content()
    {
        return view('superadmin.content');
    }

    public function news()
    {
        return view('superadmin.news');
    }

    public function articles()
    {
        return view('superadmin.articles');
    }

    public function mountains()
    {
        return view('superadmin.mountains');
    }

    public function trip()
    {
        return view('superadmin.trip');
    }

    public function booking()
    {
        return view('superadmin.booking');
    }

    public function payment()
    {
        return view('superadmin.payment');
    }

    public function community()
    {
        return view('superadmin.community');
    }

    public function points()
    {
        return view('superadmin.points');
    }

    public function rewards()
    {
        return view('superadmin.rewards');
    }

    public function reports()
    {
        return view('superadmin.reports');
    }
}
