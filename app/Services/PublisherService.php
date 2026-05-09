<?php

namespace App\Services;

use App\DTO\PublisherDTO;
use App\Models\Publisher;

class PublisherService
{
    public function getAll()
    {
        return Publisher::latest()->get();
    }

    public function store(PublisherDTO $dto)
    {
        return Publisher::create($dto->toArray());
    }

    public function find($id)
    {
        return Publisher::findOrFail($id);
    }

    public function update($id, PublisherDTO $dto)
    {
        $data = Publisher::findOrFail($id);
        $data->update($dto->toArray());
        return $data;
    }

    public function delete($id)
    {
        Publisher::findOrFail($id)->delete();
    }
}
