<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index()
    {
        // Menampilkan daftar user beserta jumlah poin mereka, urut poin terbanyak
        $users = User::orderByDesc('points')->get();
        return view('backend.points.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('backend.points.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'points' => 'required|integer|min:0',
        ]);

        $user->update([
            'points' => $request->points
        ]);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.points.index')->with('success', 'Poin pengguna berhasil diperbarui.');
    }
}

