<?php

namespace App\Http\Controllers;

use App\Services\PublisherService;
use App\DTO\PublisherDTO;
use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;

class PublisherController extends Controller
{
    public function __construct(private PublisherService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('publishers.index', compact('data'));
    }

    public function create()
    {
        return view('publishers.create');
    }

    public function store(StorePublisherRequest $request)
    {
        $dto = new PublisherDTO($request->validated());
        $this->service->store($dto);

        return redirect()->route('publishers.index')->with('success', 'Penerbit Berhasil Ditambah!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->service->find($id);
        return view('publishers.edit', compact('data'));
    }

    public function update(UpdatePublisherRequest $request, $id)
    {
        $dto = new PublisherDTO($request->validated());
        $this->service->update($id, $dto);

        return redirect()->route('publishers.index')->with('success', 'Penerbit Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success', 'Penerbit Berhasil Dihapus!');
    }
}
