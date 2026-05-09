<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\DTO\AuthorDTO;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    public function __construct(private AuthorService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('authors.index', compact('data'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        $dto = new AuthorDTO($request->validated());
        $this->service->store($dto);

        return redirect()->route('authors.index')->with('success', 'Penulis Berhasil Ditambah!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->service->find($id);
        return view('authors.edit', compact('data'));
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $dto = new AuthorDTO($request->validated());
        $this->service->update($id, $dto);

        return redirect()->route('authors.index')->with('success', 'Penulis Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success', 'Penulis Berhasil Dihapus!');
    }
}
