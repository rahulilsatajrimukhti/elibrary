<?php

namespace App\Http\Controllers;

use App\Services\UserLevelService;
use App\DTO\UserLevelDTO;
use App\Http\Requests\StoreUserLevelRequest;
use App\Http\Requests\UpdateUserLevelRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Menu;
use App\Models\UserLevel;

class UserLevelController extends Controller
{
    public function __construct(private UserLevelService $service)
    {
    }

    public function index()
    {
        $data = $this->service->getAll();
        return view('user-levels.index', compact('data'));
    }

    public function create()
    {
        return view('user-levels.create');
    }

    public function store(StoreUserLevelRequest $request)
    {
        $dto = new UserLevelDTO($request->validated());
        $this->service->store($dto);

        return redirect()->route('user-levels.index')->with('success', 'Level User Berhasil Ditambah!');
    }

    public function edit($id)
    {
        $data = $this->service->find($id);
        return view('user-levels.edit', compact('data'));
    }

    public function update(UpdateUserLevelRequest $request, $id)
    {
        $dto = new UserLevelDTO($request->validated());
        $this->service->update($id, $dto);

        return redirect()->route('user-levels.index')->with('success', 'Level User Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success', 'Level User Berhasil Dihapus!');
    }

    public function permissions(UserLevel $userLevel)
    {
        $menus = Menu::where('is_active', 1)
            ->orderBy('order')
            ->get();

        return view('user-levels.permissions', compact(
            'userLevel',
            'menus'
        ));
    }

    public function updatePermissions(
        UpdatePermissionRequest $request,
        UserLevel $userLevel,
        UserLevelService $service
    ) {
        $service->updatePermissions(
            $userLevel,
            $request->validated()['permissions'] ?? []
        );

        return back()->with(
            'success',
            'Permission Berhasil Diperbarui!'
        );
    }
}
