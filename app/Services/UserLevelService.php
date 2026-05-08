<?php

namespace App\Services;

use App\Models\UserLevel;
use App\DTO\UserLevelDTO;

class UserLevelService
{
    public function getAll()
    {
        return UserLevel::orderBy('name', 'asc')->get();
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

    public function updatePermissions($userLevel, array $permissions): void
    {
        $syncData = [];

        foreach ($permissions as $menuId => $permission) {

            $syncData[$menuId] = [
                'can_view'   => isset($permission['can_view']) ? 1 : 0,
                'can_create' => isset($permission['can_create']) ? 1 : 0,
                'can_edit'   => isset($permission['can_edit']) ? 1 : 0,
                'can_delete' => isset($permission['can_delete']) ? 1 : 0,
            ];
        }

        $userLevel->menus()->sync($syncData);
    }
}
