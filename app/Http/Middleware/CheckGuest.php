<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckGuest
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
