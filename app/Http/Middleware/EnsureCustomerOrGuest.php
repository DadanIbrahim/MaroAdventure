<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerOrGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->isAdmin() || $user->isSuperadmin() || in_array($user->role, ['admin', 'superadmin'])) {
                $message = "Akun Admin/Superadmin tidak dapat melakukan booking personal lewat halaman ini. Silakan gunakan menu 'Booking Manual' di Admin Panel.";

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => $message,
                    ], 403);
                }

                $targetRoute = $user->isSuperadmin()
                    ? route('superadmin.bookings.index')
                    : route('admin.bookings.index');

                $referer = $request->header('referer');
                if ($referer && ! str_contains($referer, '/checkout')) {
                    return redirect()->to($referer)->with('warning', $message);
                }

                return redirect()->to($targetRoute)->with('warning', $message);
            }
        }

        return $next($request);
    }
}
