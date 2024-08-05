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
    public function handle(Request $request, Closure $next)
    {
        // Debug log to check authentication status
        if (Auth::user()->role !== 'admin') {
            // Redirect to a different page if not an admin
            Log::info('not admin');
            return redirect()->route('dashboard.index')->with('error', 'You do not have admin access.');
        }

        // Proceed to the next middleware or request
        return $next($request);
    }
}
