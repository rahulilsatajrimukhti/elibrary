<?php

namespace App\Services;

use App\DTO\StoreBorrowingDTO;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingService
{
    public function getAll()
    {
        return Borrowing::with([
            'book',
            'member',
            'staff',
        ])
            ->latest()
            ->get();
    }

    public function store(StoreBorrowingDTO $dto)
    {
        return DB::transaction(function () use ($dto) {

            $book = Book::lockForUpdate()->findOrFail($dto->book_id);

            if ($book->stock < 1) {

                throw ValidationException::withMessages([
                    'book_id' => 'Stock buku habis!',
                ]);
            }

            $book->decrement('stock');

            return Borrowing::create([

                ...$dto->toArray(),

                'borrowing_code' => $this->generateCode(),
                'borrowed_by'    => Auth::id(),
                'status'         => 'borrowed',
            ]);
        });
    }

    public function find($id)
    {
        return Borrowing::with([
            'book',
            'member',
            'staff',
        ])->findOrFail($id);
    }

    public function returnBook($id)
    {
        return DB::transaction(function () use ($id) {

            $borrowing = Borrowing::with('book')
                ->findOrFail($id);

            if ($borrowing->status === 'returned') {

                throw ValidationException::withMessages([
                    'status' => 'Buku sudah dikembalikan.',
                ]);
            }

            $borrowing->book->increment('stock');

            $borrowing->update([
                'status'      => 'returned',
                'returned_at' => now(),
            ]);

            return $borrowing;
        });
    }

    protected function generateCode(): string
    {
        $lastId = Borrowing::max('id') + 1;
        return 'BRW-' . str_pad($lastId, 5, '0', STR_PAD_LEFT);
    }
}
