<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}
