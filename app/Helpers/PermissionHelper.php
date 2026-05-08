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
}
