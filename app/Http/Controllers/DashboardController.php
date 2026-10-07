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
        $posts = \App\Models\CommunityPost::with('user')->where('status', 'active')->latest()->get();
        return view('dashboard.community', compact('posts'));
    }

    public function storeCommunity(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'story' => 'required_without:image|nullable|string',
            'image' => 'required_without:story|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('community', 'public');
        }

        \App\Models\CommunityPost::create([
            'user_id' => auth()->id(),
            'content' => $request->story,
            'image' => $imagePath,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Cerita berhasil diposting!');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}
