<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next, $routeName, $permission): Response
    {
        $user = Auth::user();
        $menu = Menu::where('route', $routeName)->first();

        if (!$menu) {
            abort(403);
        }

        $access = $user->userLevel
            ->menus()
            ->where('menus.id', $menu->id)
            ->wherePivot($permission, 1)
            ->exists();

        if (!$access) {
            abort(403);
        }

        return $next($request);
    }
}
