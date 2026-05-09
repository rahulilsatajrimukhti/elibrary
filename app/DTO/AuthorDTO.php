<?php

namespace App\DTO;

class AuthorDTO
{
    public string $name;
    public ?string $bio;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->name        = $data['name'];
        $this->bio         = $data['bio'] ?? null;
        $this->is_active   = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'name'         => $this->name,
            'bio'          => $this->bio,
            'is_active'    => $this->is_active,
        ];
    }
}
