<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotFrontendAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // Save the intended URL to redirect after login
            session(['url.intended' => $request->fullUrl()]);
            return redirect()->route('frontend-login');
        }

        return $next($request);
    }
}

