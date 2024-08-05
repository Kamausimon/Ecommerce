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
        // Check if the user is authenticated
        if (!Auth::check()) {
            Log::info('User not logged in');
            return redirect()->route('Auth.login')->with('error', 'You need to be logged in to access this page.');
        }

        // Check if the authenticated user has the 'admin' role
        if (Auth::user()->role !== "admin") {
            Log::info('User tried to access an admin route');
            return redirect()->route('dashboard.index')->with('error', 'You do not have admin access.');
        }

        // Continue to the next request
        return $next($request);
    }
}
