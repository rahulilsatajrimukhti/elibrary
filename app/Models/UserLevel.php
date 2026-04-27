<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
