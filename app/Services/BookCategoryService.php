<?php

namespace App\Services;

use App\DTO\BookCategoryDTO;
use App\Models\BookCategory;

class BookCategoryService
{
    public function getAll()
    {
        return BookCategory::latest()->get();
    }

    public function store(BookCategoryDTO $dto)
    {
        return BookCategory::create($dto->toArray());
    }

    public function find($id)
    {
        return BookCategory::findOrFail($id);
    }

    public function update($id, BookCategoryDTO $dto)
    {
        $data = BookCategory::findOrFail($id);
        $data->update($dto->toArray());
        return $data;
    }

    public function delete($id)
    {
        BookCategory::findOrFail($id)->delete();
    }
}
