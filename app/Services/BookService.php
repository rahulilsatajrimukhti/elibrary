<?php

namespace App\Services;

use App\DTO\BookDTO;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookService
{
    public function getAll()
    {
        return Book::with([
            'category',
            'author',
            'publisher'
        ])->latest()->get();
    }

    public function store(
        BookDTO $dto,
        Request $request
    ) {

        $data = $dto->toArray();

        if ($request->hasFile('cover')) {

            $data['cover'] = $request->file('cover')
                ->store('books', 'public');
        }

        return Book::create($data);
    }

    public function find($id)
    {
        return Book::findOrFail($id);
    }

    public function update(
        $id,
        BookDTO $dto,
        Request $request
    ) {

        $book = Book::findOrFail($id);
        $data = $dto->toArray();
        if ($request->hasFile('cover')) {

            if (
                $book->cover &&
                Storage::disk('public')->exists($book->cover)
            ) {

                Storage::disk('public')->delete($book->cover);
            }

            $data['cover'] = $request->file('cover')
                ->store('books', 'public');
        }

        $book->update($data);

        return $book;
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if (
            $book->cover &&
            Storage::disk('public')->exists($book->cover)
        ) {

            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();
    }
}
