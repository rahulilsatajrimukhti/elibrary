<?php

namespace App\DTO;

class PublisherDTO
{
    public string $name;
    public ?string $address;
    public ?string $phone;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->name        = $data['name'];
        $this->address     = $data['address'] ?? null;
        $this->phone       = $data['phone'] ?? null;
        $this->is_active   = $data['is_active'] ?? true;
    }

    public function toArray(): array
    {
        return [
            'name'         => $this->name,
            'address'      => $this->address,
            'phone'        => $this->phone,
            'is_active'    => $this->is_active,
        ];
    }
}
