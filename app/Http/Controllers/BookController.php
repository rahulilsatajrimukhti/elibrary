<?php

namespace App\Http\Controllers;

use App\DTO\BookDTO;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\BookCategory;
use App\Models\Publisher;
use App\Services\BookService;

class BookController extends Controller
{
    public function __construct(
        protected BookService $service
    ) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('books.index', compact('data'));
    }

    public function create()
    {
        $categories = BookCategory::where('is_active', 1)->orderBy('name')->get();
        $authors    = Author::where('is_active', 1)->orderBy('name')->get();
        $publishers = Publisher::where('is_active', 1)->orderBy('name')->get();

        return view('books.create', compact(
            'categories',
            'authors',
            'publishers'
        ));
    }

    public function store(StoreBookRequest $request)
    {
        $this->service->store(
            new BookDTO($request->validated()),
            $request
        );

        return redirect()->route('books.index')->with('success', 'Buku Berhasil Ditambah!');
    }

    public function edit($id)
    {
        $data = $this->service->find($id);

        $categories = BookCategory::where('is_active', 1)->orderBy('name')->get();
        $authors    = Author::where('is_active', 1)->orderBy('name')->get();
        $publishers = Publisher::where('is_active', 1)->orderBy('name')->get();

        return view('books.edit', compact(
            'data',
            'categories',
            'authors',
            'publishers'
        ));
    }

    public function update(
        UpdateBookRequest $request,
        $id
    ) {

        $this->service->update(
            $id,
            new BookDTO($request->validated()),
            $request
        );

        return redirect()->route('books.index')->with('success', 'Buku Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()->route('books.index')->with('success', 'Buku Berhasil Dihapus!');
    }
}
