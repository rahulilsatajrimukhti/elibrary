<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'user_level_id', 'is_active'];

    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class);
    }
}
