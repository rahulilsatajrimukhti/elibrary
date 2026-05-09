<?php

namespace App\Services;

use App\DTO\AuthorDTO;
use App\Models\Author;

class AuthorService
{
    public function getAll()
    {
        return Author::latest()->get();
    }

    public function store(AuthorDTO $dto)
    {
        return Author::create($dto->toArray());
    }

    public function find($id)
    {
        return Author::findOrFail($id);
    }

    public function update($id, AuthorDTO $dto)
    {
        $data = Author::findOrFail($id);
        $data->update($dto->toArray());
        return $data;
    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();
    }
}
