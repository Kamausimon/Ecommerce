<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        }

        // Check if the authenticated user has the 'admin' role
        if (Auth::user()->role !== "admin") {
            return redirect('/products')->with('error', 'You do not have admin access.');
        }

        // Continue to the next request
        return $next($request);
    }
}
