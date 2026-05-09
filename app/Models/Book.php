<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'publisher_id',
        'title',
        'isbn',
        'publish_year',
        'stock',
        'cover',
        'description',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
