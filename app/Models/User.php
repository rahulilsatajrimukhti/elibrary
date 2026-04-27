<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'user_level_id', 'is_active'];

    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class);
    }
}
