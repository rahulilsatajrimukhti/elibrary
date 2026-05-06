<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next, $routeName)
    {
        $user = Auth::user();

        $hasAccess = $user->userLevel
            ->menus()
            ->where('route', $routeName)
            ->exists();

        if (!$hasAccess) {
            abort(403);
        }

        return $next($request);
    }
}
