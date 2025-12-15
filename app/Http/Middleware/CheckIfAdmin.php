<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
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
        // Allow only authenticated users with role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Proceed if admin
        }

        // Redirect non-admins to home (or you can use abort(403))
        return redirect()->route('home');
    }
}
