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

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'user_level_menus')
            ->withPivot([
                'can_view',
                'can_create',
                'can_edit',
                'can_delete'
            ]);
    }
}
