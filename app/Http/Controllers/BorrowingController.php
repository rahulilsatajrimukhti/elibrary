<?php

namespace App\Http\Controllers;

use App\DTO\StoreBorrowingDTO;
use App\Models\Book;
use App\Models\User;
use App\Services\BorrowingService;
use App\Http\Requests\Borrowing\StoreBorrowingRequest;

class BorrowingController extends Controller
{
    protected BorrowingService $borrowingService;

    public function __construct(BorrowingService $borrowingService)
    {
        $this->borrowingService = $borrowingService;
    }

    public function index()
    {
        $borrowings = $this->borrowingService->getAll();

        return view('borrowings.index', compact(
            'borrowings'
        ));
    }

    public function create()
    {
        $books = Book::where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('title', 'asc')
            ->get();

        $members = User::where('is_active', true)
            ->whereHas('userLevel', function ($query) {

                $query->where(
                    'name',
                    'Anggota Perpustakaan'
                );
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('borrowings.create', compact(
            'books',
            'members'
        ));
    }

    public function store(StoreBorrowingRequest $request)
    {
        $dto = new StoreBorrowingDTO(
            $request->validated()
        );

        $this->borrowingService->store($dto);

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Peminjaman Berhasil Dibuat!');
    }

    public function show(string $id)
    {
        $borrowing = $this->borrowingService->find($id);

        return view('borrowings.show', compact(
            'borrowing'
        ));
    }

    public function returnBook(string $id)
    {
        $this->borrowingService->returnBook($id);

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Buku Berhasil Dikembalikan!');
    }
}
