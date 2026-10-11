<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()
            && Auth::user()->email !== 'admin123@maroadventure.com'
            && Auth::user()->email !== 'superadmin123@maroadventure.com'
            && ! in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
