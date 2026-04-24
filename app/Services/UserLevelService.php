<?php

namespace App\Services;

use App\Models\UserLevel;
use App\DTO\UserLevelDTO;

class UserLevelService
{
    public function getAll()
    {
        return UserLevel::all();
    }

    public function store(UserLevelDTO $dto)
    {
        return UserLevel::create($dto->toArray());
    }

    public function find($id)
    {
        return UserLevel::findOrFail($id);
    }

    public function update($id, UserLevelDTO $dto)
    {
        $data = UserLevel::findOrFail($id);
        $data->update($dto->toArray());
        return $data;
    }

    public function delete($id)
    {
        UserLevel::findOrFail($id)->delete();
    }
}
