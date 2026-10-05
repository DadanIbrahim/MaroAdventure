<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperadmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->email !== 'superadmin123@maroadventure.com') {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
