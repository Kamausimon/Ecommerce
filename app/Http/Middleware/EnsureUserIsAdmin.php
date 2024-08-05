<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debug log to check authentication status
        Log::info('Auth check: ' . (Auth::check() ? 'Authenticated' : 'Guest'));

        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role === "admin") {
            return $next($request);
        }

        // Log the unauthorized access attempt
        Log::info('Unauthorized access attempt by user: ' . (Auth::check() ? Auth::user()->id : 'guest'));

        // Redirect to the login page if not authenticated
        return redirect()->route("Auth.login")->with('error', 'You need to log in to access this page.');
    }
}
