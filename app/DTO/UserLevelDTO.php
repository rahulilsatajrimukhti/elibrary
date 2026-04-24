<?php

namespace App\DTO;

class UserLevelDTO
{
    public string $name;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->name      = $data['name'];
        $this->is_active = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'name'      => $this->name,
            'is_active' => $this->is_active
        ];
    }
}
