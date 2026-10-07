<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with('mountain')->latest()->get();
        return view('backend.trips.index', compact('trips'));
    }

    public function create()
    {
        $mountains = Mountain::where('status', 1)->get();
        return view('backend.trips.create', compact('mountains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mountain_id' => 'required|exists:mountains,id',
            'name' => 'required|string|max:255',
            'duration' => 'nullable|string|max:255',
            'price' => 'required|string', // String because it will contain Rp/dots
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image', 'price');
        
        // Convert formatted price "Rp 1.500.000" to integer 1500000
        $data['price'] = (int) preg_replace('/[^0-9]/', '', $request->price);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('trips', 'public');
        }

        Trip::create($data);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.trips.index')->with('success', 'Paket Trip berhasil ditambahkan.');
    }

    public function edit(Trip $trip)
    {
        $mountains = Mountain::all();
        return view('backend.trips.edit', compact('trip', 'mountains'));
    }

    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'mountain_id' => 'required|exists:mountains,id',
            'name' => 'required|string|max:255',
            'duration' => 'nullable|string|max:255',
            'price' => 'required|string',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image', 'price');
        
        // Convert formatted price "Rp 1.500.000" to integer 1500000
        $data['price'] = (int) preg_replace('/[^0-9]/', '', $request->price);

        if ($request->hasFile('image')) {
            if ($trip->image) {
                Storage::disk('public')->delete($trip->image);
            }
            $data['image'] = $request->file('image')->store('trips', 'public');
        }

        $trip->update($data);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.trips.index')->with('success', 'Paket Trip berhasil diperbarui.');
    }

    public function destroy(Trip $trip)
    {
        if ($trip->image) {
            Storage::disk('public')->delete($trip->image);
        }
        
        $trip->delete();

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.trips.index')->with('success', 'Paket Trip berhasil dihapus.');
    }
}

