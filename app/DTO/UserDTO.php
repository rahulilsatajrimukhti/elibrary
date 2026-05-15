<?php

namespace App\DTO;

class UserDTO
{
    public ?string $member_code;
    public string $name;
    public string $email;
    public ?string $phone;
    public ?string $address;
    public string $password;
    public int $user_level_id;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->member_code      = $data['member_code'] ?? null;
        $this->name             = $data['name'];
        $this->email            = $data['email'];
        $this->phone            = $data['phone'] ?? null;
        $this->address          = $data['address'] ?? null;
        $this->password         = $data['password'] ?? '';
        $this->user_level_id    = $data['user_level_id'];
        $this->is_active        = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'member_code'   => $this->member_code,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'password'      => $this->password,
            'user_level_id' => $this->user_level_id,
            'is_active'     => $this->is_active
        ];
    }
}
