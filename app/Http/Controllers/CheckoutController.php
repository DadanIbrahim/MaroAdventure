<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mountain;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout formulir pemesanan.
     */
    public function index(Request $request): View
    {
        // Pastikan ada trip jika database masih kosong
        if (Trip::count() === 0) {
            $mountain = Mountain::first() ?? Mountain::create([
                'name' => 'Gunung Burangrang',
                'location' => 'Bandung Barat, Jawa Barat',
                'elevation' => 2050,
                'description' => 'Gunung dengan ketinggian 2.050 MDPL di kawasan Bandung Barat yang menyajikan panorama alam dan Danau Situ Lembang.',
                'image' => null,
                'status' => true,
            ]);

            Trip::create([
                'mountain_id' => $mountain->id,
                'name' => 'Burangrang Weekend Camp & Trekking',
                'duration' => '2 Hari 1 Malam',
                'price' => 350000,
                'status' => 1,
                'description' => 'Pendakian santai dan camp di puncak Gunung Burangrang dengan pemandangan sunrise Danau Situ Lembang.',
                'image' => null,
            ]);

            Trip::create([
                'mountain_id' => $mountain->id,
                'name' => 'Burangrang One Day Sunrise Expedition',
                'duration' => '1 Hari (Sunrise)',
                'price' => 220000,
                'status' => 1,
                'description' => 'Trekking malam mengejar golden sunrise spektakuler di puncak Burangrang 2.050 MDPL.',
                'image' => null,
            ]);
        }

        $trips = Trip::with('mountain')->where('status', 1)->get();

        // Cari trip yang dipilih lewat query parameter ?trip_id=...
        $selectedTripId = $request->query('trip_id');
        $selectedTrip = null;

        if ($selectedTripId) {
            $selectedTrip = $trips->firstWhere('id', $selectedTripId);
        }

        if (! $selectedTrip && $trips->isNotEmpty()) {
            $selectedTrip = $trips->first();
        }

        return view('checkout.index', compact('trips', 'selectedTrip'));
    }

    /**
     * Proses penyimpanan booking checkout.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:30',
            'booking_date' => 'required|date|after_or_equal:today',
            'participants' => 'required|integer|min:1|max:50',
            'emergency_name' => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:30',
            'notes' => 'nullable|string|max:1000',
        ]);

        $trip = Trip::findOrFail($validated['trip_id']);
        $participants = (int) $validated['participants'];
        $totalPrice = $trip->price * $participants;

        // Gabungkan catatan medis dan kontak darurat jika diisi
        $notesParts = [];
        if (! empty($validated['emergency_name']) || ! empty($validated['emergency_phone'])) {
            $notesParts[] = 'Kontak Darurat: '.($validated['emergency_name'] ?? '-').' ('.($validated['emergency_phone'] ?? '-').')';
        }
        if (! empty($validated['notes'])) {
            $notesParts[] = 'Catatan: '.$validated['notes'];
        }
        $fullNotes = ! empty($notesParts) ? implode(' | ', $notesParts) : null;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'trip_id' => $trip->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'booking_date' => $validated['booking_date'],
            'participants' => $participants,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'notes' => $fullNotes,
        ]);

        return redirect()->route('checkout.payment', ['booking_code' => $booking->booking_code])
            ->with('success', 'Pemesanan tiket berhasil dibuat! Silakan pilih metode pembayaran.');
    }

    /**
     * Tampilkan halaman pembayaran checkout.
     */
    public function payment(Request $request): View
    {
        $bookingCode = $request->query('booking_code');
        $booking = null;

        if ($bookingCode) {
            $booking = Booking::with(['trip.mountain', 'user'])
                ->where('booking_code', $bookingCode)
                ->first();
        }

        // Fallback ke booking pending terbaru milik user jika booking_code tidak spesifik
        if (! $booking && Auth::check()) {
            $booking = Booking::with(['trip.mountain', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->first();
        }

        return view('checkout.payment', compact('booking'));
    }

    /**
     * Tampilkan halaman sukses checkout.
     */
    public function success(Request $request): View
    {
        $bookingCode = $request->query('booking_code');
        $booking = null;

        if ($bookingCode) {
            $booking = Booking::with(['trip.mountain', 'user'])
                ->where('booking_code', $bookingCode)
                ->first();
        }

        if (! $booking && Auth::check()) {
            $booking = Booking::with(['trip.mountain', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->first();
        }

        return view('checkout.success', compact('booking'));
    }
}
