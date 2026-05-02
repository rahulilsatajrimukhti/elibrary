<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Hash;

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
        $data               = $dto->toArray();
        $data['password']   = Hash::make($data['password']);

        return User::create($data);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, UserDTO $dto)
    {
        $data       = User::findOrFail($id);
        $payload    = $dto->toArray();

        if (!empty($payload['password'])) {
            $payload['password'] = Hash::make($payload['password']);
        } else {
            unset($payload['password']);
        }

        $data->update($payload);

        return $data;
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
