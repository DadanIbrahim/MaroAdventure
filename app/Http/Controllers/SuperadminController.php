<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SuperadminController extends Controller
{
    /**
     * Dashboard ringkasan Superadmin.
     */
    public function dashboard(): View
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_price');
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalTrips = Trip::count();
        $recentBookings = Booking::with(['user', 'trip'])->latest()->take(5)->get();

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalRevenue',
            'totalBookings',
            'pendingBookings',
            'totalTrips',
            'recentBookings'
        ));
    }

    /**
     * Tampilkan daftar user dengan pencarian dan filter.
     */
    public function users(Request $request): View
    {
        // Akun superadmin tidak ditampilkan di user management karena tidak dapat diubah
        $query = User::where('role', '!=', 'superadmin')
            ->where('email', '!=', 'superadmin123@maroadventure.com');

        // Pencarian berdasarkan nama, email, atau no telepon
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan role (hanya user dan admin)
        if ($role = $request->input('role')) {
            if (in_array($role, ['user', 'admin'])) {
                $query->where('role', $role);
            }
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('superadmin.users', compact('users'));
    }

    /**
     * Simpan user baru dari modal Add User.
     */
    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'role' => 'required|in:user,admin',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'role.in' => 'Role yang dapat ditambahkan hanya Admin atau User.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'points' => 0,
        ]);

        return redirect()->route('superadmin.users')
            ->with('success', 'User baru "'.$validated['name'].'" berhasil ditambahkan!');
    }

    /**
     * Perbarui data user yang sudah ada.
     */
    public function updateUser(Request $request, User $user): RedirectResponse
    {
        // Lindungi akun superadmin agar tidak dapat diubah
        if ($user->role === 'superadmin' || $user->email === 'superadmin123@maroadventure.com') {
            return redirect()->route('superadmin.users')
                ->with('error', 'Akun Superadmin tidak dapat diubah.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:30',
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'role.in' => 'Role hanya dapat diatur sebagai Admin atau User.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
        ];

        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('superadmin.users')
            ->with('success', 'Data user "'.$user->name.'" berhasil diperbarui!');
    }

    /**
     * Hapus user dari database.
     */
    public function destroyUser(User $user): RedirectResponse
    {
        if ($user->role === 'superadmin' || $user->email === 'superadmin123@maroadventure.com') {
            return redirect()->route('superadmin.users')
                ->with('error', 'Akun Superadmin tidak dapat dihapus.');
        }

        if (Auth::id() === $user->id) {
            return redirect()->route('superadmin.users')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('superadmin.users')
            ->with('success', 'User "'.$userName.'" berhasil dihapus.');
    }

    /**
     * Tampilan konten superadmin.
     */
    public function content(): View
    {
        return view('superadmin.content');
    }
}
