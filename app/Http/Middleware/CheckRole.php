<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- Added the official Auth Facade

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Ensure user is actually logged in using the Auth facade
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Clean the database role (lowercase, remove spaces) just to be safe
        $userRole = strtolower(trim(Auth::user()->role));

        // 3. If roles match, let them through!
        if ($userRole === $role) {
            return $next($request);
        }

        // 4. If they don't match, strictly block them without redirecting to avoid infinite loops
        abort(403, 'Access Denied: You do not have permission to view this page.');
    }
}
