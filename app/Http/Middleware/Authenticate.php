<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\UrlGenerator
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // If the user is not authenticated, redirect to the login page
        if (Auth::guard($guards)->guest()) {
            return redirect()->route('admin.login');  // Redirect to the login page if the user is not logged in
        }

        return $next($request);  // Proceed to the next request if the user is authenticated
    }
}

