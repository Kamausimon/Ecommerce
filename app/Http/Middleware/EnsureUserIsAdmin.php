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

     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            Log::info('User not authenticated');
            return redirect()->route('Auth.login')->with('error', 'Please log in to access this page.');
        }

        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            Log::info('User is not an admin');
            return redirect()->route('dashboard.index')->with('error', 'You do not have admin access.');
        }

        // Proceed to the next middleware or request
        return $next($request);
    }
}
