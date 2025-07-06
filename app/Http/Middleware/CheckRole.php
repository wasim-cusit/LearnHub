<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($role === 'teacher' && !$user->isTeacher()) {
            abort(403, 'Access denied. Teachers only.');
        }

        if ($role === 'student' && !$user->isStudent()) {
            abort(403, 'Access denied. Students only.');
        }

        return $next($request);
    }
}
