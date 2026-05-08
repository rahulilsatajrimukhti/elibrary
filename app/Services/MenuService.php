<?php

namespace App\Services;

use App\DTO\MenuDTO;
use App\Models\Menu;

class MenuService
{
    public function getAll()
    {
        return Menu::whereNull('parent_id')
            ->with([
                'children' => function ($q) {
                    $q->orderBy('order');
                }
            ])
            ->orderBy('order')
            ->get();
    }

    public function getParentMenus()
    {
        return Menu::whereNull('parent_id')->orderBy('order')->get();
    }

    public function store(MenuDTO $dto)
    {
        return Menu::create($dto->toArray());
    }

    public function find($id)
    {
        return Menu::findOrFail($id);
    }

    public function update($id, MenuDTO $dto)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($dto->toArray());
        return $menu;
    }

    public function delete($id)
    {
        Menu::findOrFail($id)->delete();
    }
}
