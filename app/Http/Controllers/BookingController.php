<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['trip', 'user'])->latest()->get();

        return view('backend.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $trips = Trip::where('status', 1)->get();

        return view('backend.bookings.create', compact('trips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'booking_date' => 'required|date',
            'participants' => 'required|integer|min:1',
            'total_price' => 'required|string', // String karena input mengandung "Rp" dan titik
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'payment_status' => 'required|in:unpaid,paid',
            'notes' => 'nullable|string',
        ]);

        $data = $request->except('total_price');

        // Membersihkan format Rupiah (contoh: "Rp 1.500.000" menjadi 1500000)
        $data['total_price'] = (int) preg_replace('/[^0-9]/', '', $request->total_price);

        Booking::create($data);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.bookings.index')->with('success', 'Data Booking berhasil ditambahkan.');
    }

    public function edit(Booking $booking)
    {
        if (! $booking->is_read) {
            $booking->update(['is_read' => true]);
        }

        $trips = Trip::all();

        return view('backend.bookings.edit', compact('booking', 'trips'));
    }

    /**
     * Tandai notifikasi spesifik sebagai sudah dibaca lalu alihkan ke halaman detail/edit booking.
     */
    public function markAsReadAndRedirect(Booking $booking)
    {
        if (! $booking->is_read) {
            $booking->update(['is_read' => true]);
        }

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.bookings.edit', $booking->id);
    }

    /**
     * Tandai semua notifikasi pemesanan sebagai sudah dibaca.
     */
    public function markAllRead(Request $request)
    {
        Booking::where('is_read', false)->update(['is_read' => true]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Semua notifikasi pemesanan telah ditandai dibaca.');
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'booking_date' => 'required|date',
            'participants' => 'required|integer|min:1',
            'total_price' => 'required|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'payment_status' => 'required|in:unpaid,paid',
            'notes' => 'nullable|string',
        ]);

        $data = $request->except('total_price');

        // Membersihkan format Rupiah (contoh: "Rp 1.500.000" menjadi 1500000)
        $data['total_price'] = (int) preg_replace('/[^0-9]/', '', $request->total_price);

        $booking->update($data);

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.bookings.index')->with('success', 'Data Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';

        return redirect()->route($prefix.'.bookings.index')->with('success', 'Data Booking berhasil dihapus.');
    }
}
