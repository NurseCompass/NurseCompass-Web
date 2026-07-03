<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if user is logged in AND their role matches the requirement
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // If they don't match, kick them back to their own dashboard
        return redirect('/dashboard')->with('error', 'You do not have permission to access that area.');
    }
}
