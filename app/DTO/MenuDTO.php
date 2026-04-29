<?php

namespace App\DTO;

class MenuDTO
{
    public string $name;
    public ?string $route;
    public ?string $icon;
    public ?int $parent_id;
    public int $order;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->name      = $data['name'];
        $this->route     = $data['route'] ?? null;
        $this->icon      = $data['icon'] ?? null;
        $this->parent_id = $data['parent_id'] ?? null;
        $this->order     = $data['order'] ?? 0;
        $this->is_active = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'name'       => $this->name,
            'route'      => $this->route,
            'icon'       => $this->icon,
            'parent_id'  => $this->parent_id,
            'order'      => $this->order,
            'is_active'  => $this->is_active,
        ];
    }
}
