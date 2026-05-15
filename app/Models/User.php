<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'member_code',
        'name',
        'email',
        'phone',
        'address',
        'avatar',
        'password',
        'user_level_id',
        'is_active'
    ];

    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class);
    }

    public function hasPermission($route, $permission)
    {
        return $this->userLevel
            ->menus()
            ->where('route', $route)
            ->wherePivot($permission, 1)
            ->exists();
    }
}
