<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('canAccess')) {

    function canAccess($route, $permission): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $user->hasPermission($route, $permission);
    }

    if (!function_exists('activeMenu')) {

        function activeMenu($route): string
        {
            return request()->routeIs($route) ? 'active' : '';
        }
    }

    if (!function_exists('menuOpen')) {

        function menuOpen($children): bool
        {
            foreach ($children as $child) {

                if ($child->route && request()->routeIs($child->route)) {
                    return true;
                }
            }

            return false;
        }
    }
}
