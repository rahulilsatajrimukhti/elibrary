<?php

namespace App\DTO;

class StoreBorrowingDTO
{
    public int $book_id;
    public int $member_id;
    public string $borrowed_at;
    public string $due_date;
    public ?string $notes;
    public function __construct(array $data)
    {
        $this->book_id      = $data['book_id'];
        $this->member_id    = $data['member_id'];
        $this->borrowed_at  = $data['borrowed_at'];
        $this->due_date     = $data['due_date'];
        $this->notes        = $data['notes'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'book_id'      => $this->book_id,
            'member_id'    => $this->member_id,
            'borrowed_at'  => $this->borrowed_at,
            'due_date'     => $this->due_date,
            'notes'        => $this->notes,
        ];
    }
}
