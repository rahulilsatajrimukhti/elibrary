<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use App\Models\UserLevel;

class UserService
{
    public function getAll()
    {
        return User::orderBy('name', 'asc')->get();
    }

    public function getUserLevel()
    {
        return UserLevel::orderBy('name', 'asc')->get();
    }

    public function store(UserDTO $dto)
    {
        return User::create($dto->toArray());
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, UserDTO $dto)
    {
        $data = User::findOrFail($id);
        $data->update($dto->toArray());
        return $data;
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
