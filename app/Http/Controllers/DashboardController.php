<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CommunityPost;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Query bookings user
        $userBookingsQuery = Booking::with(['trip.mountain'])
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);
                if (! empty($user->phone)) {
                    $q->orWhere('customer_phone', $user->phone);
                }
            });

        $totalTrips = (clone $userBookingsQuery)->count();

        $activeTrips = (clone $userBookingsQuery)
            ->whereIn('status', ['confirmed', 'pending'])
            ->count();

        $completedTrips = (clone $userBookingsQuery)
            ->where('status', 'completed')
            ->count();

        $userPoints = $user->points ?? 0;

        $recentBookings = (clone $userBookingsQuery)
            ->latest()
            ->take(5)
            ->get();

        $userStoriesCount = CommunityPost::where('user_id', $user->id)->count();

        return view('dashboard.index', compact(
            'totalTrips',
            'activeTrips',
            'completedTrips',
            'userPoints',
            'recentBookings',
            'userStoriesCount'
        ));
    }

    public function bookings()
    {
        $user = auth()->user();
        $bookings = Booking::with(['trip.mountain', 'payments'])
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);
                if (! empty($user->phone)) {
                    $q->orWhere('customer_phone', $user->phone);
                }
            })
            ->latest()
            ->get();

        return view('dashboard.bookings', compact('bookings'));
    }

    public function showBooking($id)
    {
        $user = auth()->user();
        $booking = Booking::with(['trip.mountain', 'payments', 'user'])
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);
                if (! empty($user->phone)) {
                    $q->orWhere('customer_phone', $user->phone);
                }
            })
            ->where(function ($q) use ($id) {
                $q->where('id', $id)->orWhere('booking_code', $id);
            })
            ->firstOrFail();

        return view('dashboard.booking_detail', compact('booking', 'id'));
    }

    public function points()
    {
        $user = auth()->user();

        // Pastikan ada rewards awal jika database masih kosong
        if (Reward::count() === 0) {
            Reward::create([
                'name' => 'Diskon Trip Rp 50.000',
                'description' => 'Potongan langsung Rp 50.000 untuk pendaftaran open trip atau private trip berikutnya.',
                'points_required' => 500,
                'stock' => 50,
                'is_active' => true,
            ]);
            Reward::create([
                'name' => 'Gratis Sewa Tenda Dome (1 Malam)',
                'description' => 'Voucher gratis sewa tenda kapasitas 4 orang untuk 1 malam di basecamp pendakian.',
                'points_required' => 800,
                'stock' => 20,
                'is_active' => true,
            ]);
            Reward::create([
                'name' => 'Kaos Exclusive Maro Adventure',
                'description' => 'Merchandise kaos katun combed premium edisi penjelajah rimba Maro Adventure.',
                'points_required' => 1200,
                'stock' => 15,
                'is_active' => true,
            ]);
            Reward::create([
                'name' => 'Voucher Kopi & Snack Basecamp',
                'description' => 'Gratis 1 cangkir kopi tubruk nusantara dan pisang goreng hangat di pos pendakian.',
                'points_required' => 250,
                'stock' => 100,
                'is_active' => true,
            ]);
        }

        $rewards = Reward::where('is_active', true)->orderBy('points_required')->get();
        $userPoints = $user->points ?? 0;

        // Ambil voucher yang pernah ditukarkan oleh user
        $myVouchers = session()->get('redeemed_vouchers_'.$user->id, []);

        return view('dashboard.points', compact('rewards', 'userPoints', 'myVouchers'));
    }

    public function redeemReward(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $user = auth()->user();
        $reward = Reward::findOrFail($request->reward_id);

        if (! $reward->is_active || $reward->stock <= 0) {
            return redirect()->back()->with('error', 'Hadiah ini sedang tidak tersedia atau stok habis.');
        }

        if (($user->points ?? 0) < $reward->points_required) {
            return redirect()->back()->with('error', 'Poin Anda tidak mencukupi untuk menukar hadiah ini. Poin Anda: '.number_format($user->points ?? 0, 0, ',', '.').', dibutuhkan: '.number_format($reward->points_required, 0, ',', '.').' poin.');
        }

        // Potong poin user
        $user->decrement('points', $reward->points_required);

        // Kurangi stok reward
        if ($reward->stock > 0) {
            $reward->decrement('stock', 1);
        }

        // Generate kode voucher
        $voucherCode = 'MARO-'.strtoupper(substr(md5(uniqid()), 0, 6));

        // Simpan ke voucher aktif user
        $myVouchers = session()->get('redeemed_vouchers_'.$user->id, []);
        $myVouchers[] = [
            'id' => uniqid(),
            'reward_id' => $reward->id,
            'title' => $reward->name,
            'description' => $reward->description,
            'code' => $voucherCode,
            'points_spent' => $reward->points_required,
            'redeemed_at' => now()->format('d M Y, H:i'),
            'valid_until' => now()->addMonths(6)->format('d M Y'),
        ];
        session()->put('redeemed_vouchers_'.$user->id, $myVouchers);

        return redirect()->route('dashboard.points')
            ->with('success', 'Selamat! Penukaran poin untuk "'.$reward->name.'" berhasil. Kode Voucher: '.$voucherCode);
    }

    public function community()
    {
        $posts = CommunityPost::with('user')->where('status', 'active')->latest()->get();

        return view('dashboard.community', compact('posts'));
    }

    public function storeCommunity(Request $request)
    {
        $request->validate([
            'story' => 'required_without:image|nullable|string',
            'image' => 'required_without:story|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('community', 'public');
        }

        CommunityPost::create([
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

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
        ];

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $updateData['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($updateData);

        return redirect()->route('dashboard.profile')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.current_password' => 'Password saat ini tidak cocok dengan data kami.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal 6 karakter.',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard.profile')->with('success', 'Password Anda berhasil diperbarui!');
    }
}
