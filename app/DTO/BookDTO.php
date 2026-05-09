<?php

namespace App\DTO;

class BookDTO
{
    public string $title;
    public int $category_id;
    public int $author_id;
    public int $publisher_id;
    public ?string $isbn;
    public ?string $publish_year;
    public int $stock;
    public ?string $description;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->title         = $data['title'];

        $this->category_id   = $data['category_id'];
        $this->author_id     = $data['author_id'];
        $this->publisher_id  = $data['publisher_id'];
        $this->isbn          = $data['isbn'] ?? null;
        $this->publish_year  = $data['publish_year'] ?? null;
        $this->stock         = $data['stock'] ?? 0;
        $this->description   = $data['description'] ?? null;
        $this->is_active     = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'title'         => $this->title,
            'category_id'   => $this->category_id,
            'author_id'     => $this->author_id,
            'publisher_id'  => $this->publisher_id,
            'isbn'          => $this->isbn,
            'publish_year'  => $this->publish_year,
            'stock'         => $this->stock,
            'description'   => $this->description,
            'is_active'     => $this->is_active,
        ];
    }
}
