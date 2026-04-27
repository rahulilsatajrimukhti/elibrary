<?php

namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;
    public int $user_level_id;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->name             = $data['name'];
        $this->email            = $data['email'];
        $this->password         = $data['password'] ?? '';
        $this->user_level_id    = $data['user_level_id'];
        $this->is_active        = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => $this->password,
            'user_level_id' => $this->user_level_id,
            'is_active'     => $this->is_active
        ];
    }
}
