<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(private UserService $service) {}

    public function index()
    {
        $data = $this->service->getAll();
        return view('users.index', compact('data'));
    }

    public function create()
    {
        $levels = $this->service->getUserLevel();
        return view('users.create', compact('levels'));
    }

    public function store(StoreUserRequest $request)
    {
        $dto = new UserDTO($request->validated());
        $this->service->store($dto);

        return redirect()->route('users.index')->with('success', 'User Berhasil Ditambah!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data   = $this->service->find($id);
        $levels = $this->service->getUserLevel();
        return view('users.edit', compact('data', 'levels'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $dto = new UserDTO($request->validated());
        $this->service->update($id, $dto);

        return redirect()->route('users.index')->with('success', 'User Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success', 'User Berhasil Dihapus!');
    }
}
