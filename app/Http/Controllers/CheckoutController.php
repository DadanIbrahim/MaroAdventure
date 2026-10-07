<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout.
     */
    public function index(): View
    {
        return view('checkout.index');
    }

    /**
     * Tampilkan halaman pembayaran checkout.
     */
    public function payment(): View
    {
        return view('checkout.payment');
    }

    /**
     * Tampilkan halaman sukses checkout.
     */
    public function success(): View
    {
        return view('checkout.success');
    }
}
