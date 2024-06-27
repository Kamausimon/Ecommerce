<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Attempt to connect to the database
        try {
            DB::connection()->getPdo();
            Log::info('Database connection established successfully.');
        } catch (\Exception $e) {
            Log::error('Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage());
        }

        return $next($request);
    }
}
