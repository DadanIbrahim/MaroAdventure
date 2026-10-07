<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->latest()->get();
        return view('backend.payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = Booking::where('payment_status', 'unpaid')->get();
        return view('backend.payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|string',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,verified,rejected',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string'
        ]);

        $data = $request->except('amount', 'payment_proof');
        $data['amount'] = (int) preg_replace('/[^0-9]/', '', $request->amount);

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payments', 'public');
        }

        $payment = Payment::create($data);

        // Jika diverifikasi langsung, update booking menjadi lunas
        if ($payment->status === 'verified') {
            $payment->booking->update(['payment_status' => 'paid']);
        }

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.payments.index')->with('success', 'Data Pembayaran berhasil dicatat.');
    }

    public function edit(Payment $payment)
    {
        $bookings = Booking::all();
        return view('backend.payments.edit', compact('payment', 'bookings'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|string',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,verified,rejected',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string'
        ]);

        $data = $request->except('amount', 'payment_proof');
        $data['amount'] = (int) preg_replace('/[^0-9]/', '', $request->amount);

        if ($request->hasFile('payment_proof')) {
            if ($payment->payment_proof) {
                Storage::disk('public')->delete($payment->payment_proof);
            }
            $data['payment_proof'] = $request->file('payment_proof')->store('payments', 'public');
        }

        $payment->update($data);

        // Auto update status pembayaran di tabel booking
        if ($payment->status === 'verified') {
            $payment->booking->update(['payment_status' => 'paid']);
        } elseif ($payment->status === 'rejected') {
            $payment->booking->update(['payment_status' => 'unpaid']);
        }

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.payments.index')->with('success', 'Status Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }
        $payment->delete();

        $prefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
        return redirect()->route($prefix . '.payments.index')->with('success', 'Data Pembayaran dihapus.');
    }
}

