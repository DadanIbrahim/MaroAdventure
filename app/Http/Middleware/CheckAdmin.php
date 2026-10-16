<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Superadmin harus menggunakan route superadmin, bukan admin
        if ($user->isSuperadmin()) {
            return redirect()->route('superadmin.dashboard')->with('info', 'Anda login sebagai Superadmin.');
        }

        if (! $user->isAdmin()) {
            return redirect()->route('dashboard.index')->with('error', 'Akses ditolak. Halaman ini hanya untuk Administrator.');
        }

        return $next($request);
    }
}
