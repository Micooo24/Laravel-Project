<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateWithMessage
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('/auth/login')->with('message', 'You need to log in first.');
        }

        return $next($request);
    }
}
