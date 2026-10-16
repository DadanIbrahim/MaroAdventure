<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperadmin
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (! Auth::user()->isSuperadmin()) {
            $target = Auth::user()->role === 'admin' ? 'admin.dashboard' : 'dashboard.index';

            return redirect()->route($target)->with('error', 'Akses ditolak. Halaman ini hanya untuk Superadmin.');
        }

        return $next($request);
    }
}
