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
        $data             = $dto->toArray();
        $data['password'] = Hash::make($data['password']);
        $userLevel        = UserLevel::find($data['user_level_id']);

        if (
            $userLevel &&
            strtolower($userLevel->name) === 'anggota perpustakaan'
        ) {

            $lastMember = User::whereNotNull('member_code')->count() + 1;

            $data['member_code'] = 'MBR-' . str_pad(
                $lastMember,
                4,
                '0',
                STR_PAD_LEFT
            );
        } else {

            $data['member_code'] = null;
        }

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

        $userLevel = UserLevel::find($payload['user_level_id']);

        if (
            $userLevel &&
            strtolower($userLevel->name) === 'anggota perpustakaan'
        ) {

            if (!$data->member_code) {

                $lastMember = User::whereNotNull('member_code')->count() + 1;

                $payload['member_code'] = 'MBR-' . str_pad(
                    $lastMember,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        } else {

            $payload['member_code'] = null;
        }

        $data->update($payload);

        return $data;
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
