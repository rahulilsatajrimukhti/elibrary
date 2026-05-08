<?php

namespace App\Http\Controllers;

use App\Services\BookCategoryService;
use App\DTO\BookCategoryDTO;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Requests\UpdateBookCategoryRequest;

class BookCategoryController extends Controller
{
    public function __construct(private BookCategoryService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('categories.index', compact('data'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreBookCategoryRequest $request)
    {
        $dto = new BookCategoryDTO($request->validated());
        $this->service->store($dto);

        return redirect()->route('categories.index')->with('success', 'Kategori Buku Berhasil Ditambah!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->service->find($id);
        return view('categories.edit', compact('data'));
    }

    public function update(UpdateBookCategoryRequest $request, $id)
    {
        $dto = new BookCategoryDTO($request->validated());
        $this->service->update($id, $dto);

        return redirect()->route('categories.index')->with('success', 'Kategori Buku Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success', 'Kategori Buku Berhasil Dihapus!');
    }
}
