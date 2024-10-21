<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user is authenticated and is an admin
       if (Auth::check() && Auth::user()->admin) {
        return $next($request); // Allow access if the user is an admin
        }

        // Otherwise, abort with a 403 Forbidden response
        abort(403, 'Unauthorized access');
    }
}
