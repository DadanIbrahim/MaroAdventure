<?php

namespace App\Http\Controllers;

use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MountainController extends Controller
{
    public function index()
    {
        $mountains = Mountain::latest()->get();
        return view('backend.mountains.index', compact('mountains'));
    }

    public function create()
    {
        return view('backend.mountains.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'elevation' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('mountains', 'public');
        }

        Mountain::create($data);

        return redirect()->route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.index' : 'admin.mountains.index')
            ->with('success', 'Gunung berhasil ditambahkan.');
    }

    public function edit(Mountain $mountain)
    {
        return view('backend.mountains.edit', compact('mountain'));
    }

    public function update(Request $request, Mountain $mountain)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'elevation' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($mountain->image) {
                Storage::disk('public')->delete($mountain->image);
            }
            $data['image'] = $request->file('image')->store('mountains', 'public');
        }

        $mountain->update($data);

        return redirect()->route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.index' : 'admin.mountains.index')
            ->with('success', 'Data gunung berhasil diperbarui.');
    }

    public function destroy(Mountain $mountain)
    {
        if ($mountain->image) {
            Storage::disk('public')->delete($mountain->image);
        }
        $mountain->delete();

        return redirect()->route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.index' : 'admin.mountains.index')
            ->with('success', 'Data gunung berhasil dihapus.');
    }
}

