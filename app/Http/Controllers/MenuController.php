<?php

namespace App\Http\Controllers;

use App\DTO\MenuDTO;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Services\MenuService;

class MenuController extends Controller
{
    public function __construct(private MenuService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('menus.index', compact('data'));
    }

    public function create()
    {
        $parents = $this->service->getParentMenus();
        return view('menus.create', compact('parents'));
    }

    public function store(StoreMenuRequest $request)
    {
        $dto = new MenuDTO($request->validated());
        $this->service->store($dto);

        return redirect()->route('menus.index')->with('success', 'Menu Berhasil Ditambah!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->service->find($id);
        $parents = $this->service->getParentMenus();

        return view('menus.edit', compact('data', 'parents'));
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        $dto = new MenuDTO($request->validated());
        $this->service->update($id, $dto);

        return redirect()->route('menus.index')->with('success', 'Menu Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return back()->with('success', 'Menu Berhasil Dihapus!');
    }
}
