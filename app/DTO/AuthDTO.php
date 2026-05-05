<?php

namespace App\DTO;

class AuthDTO
{
    public string $email;
    public string $password;

    public function __construct(array $data)
    {
        $this->email    = $data['email'];
        $this->password = $data['password'];
    }

    public function toArray(): array
    {
        return [
            'email'    => $this->email,
            'password' => $this->password,
        ];
    }
}
