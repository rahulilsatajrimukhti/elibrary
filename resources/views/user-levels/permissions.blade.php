@extends('layouts.app')
@section('title', 'Permission User Level')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('user-levels.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">

                <i class="fas fa-arrow-left"></i>
            </a>

            <h5 class="mb-0 font-weight-bold text-gray-800">
                Permission - {{ $userLevel->name }}
            </h5>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2 px-3 small shadow-sm">
                <i class="fas fa-check-circle mr-1"></i>
                {{ session('success') }}

                <button type="button" class="close p-1" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <form method="POST" action="{{ route('user-levels.permissions.update', $userLevel->id) }}">

                    @csrf
                    @method('PUT')

                    <table class="table table-sm table-hover mb-0">

                        <thead class="bg-light">
                            <tr class="small text-muted text-center">
                                <th class="text-left pl-3">Menu</th>
                                <th width="120">View</th>
                                <th width="120">Create</th>
                                <th width="120">Edit</th>
                                <th width="120">Delete</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($menus as $menu)

                                {{-- PARENT MENU --}}
                                @php
                                    $permission = $userLevel->menus->where('id', $menu->id)->first();
                                @endphp

                                <tr class="bg-light">

                                    <td class="pl-3 align-middle small font-weight-bold text-gray-700">
                                        <i class="fas fa-folder-open text-primary mr-2"></i>
                                        {{ $menu->name }}
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-switch d-inline-block">
                                            <input type="checkbox" class="custom-control-input"
                                                id="view_{{ $menu->id }}"
                                                name="permissions[{{ $menu->id }}][can_view]" value="1"
                                                {{ optional($permission)?->pivot?->can_view ? 'checked' : '' }}>

                                            <label class="custom-control-label" for="view_{{ $menu->id }}"></label>
                                        </div>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-switch d-inline-block">
                                            <input type="checkbox" class="custom-control-input"
                                                id="create_{{ $menu->id }}"
                                                name="permissions[{{ $menu->id }}][can_create]" value="1"
                                                {{ optional($permission)?->pivot?->can_create ? 'checked' : '' }}>

                                            <label class="custom-control-label" for="create_{{ $menu->id }}"></label>
                                        </div>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-switch d-inline-block">
                                            <input type="checkbox" class="custom-control-input"
                                                id="edit_{{ $menu->id }}"
                                                name="permissions[{{ $menu->id }}][can_edit]" value="1"
                                                {{ optional($permission)?->pivot?->can_edit ? 'checked' : '' }}>

                                            <label class="custom-control-label" for="edit_{{ $menu->id }}"></label>
                                        </div>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-switch d-inline-block">
                                            <input type="checkbox" class="custom-control-input"
                                                id="delete_{{ $menu->id }}"
                                                name="permissions[{{ $menu->id }}][can_delete]" value="1"
                                                {{ optional($permission)?->pivot?->can_delete ? 'checked' : '' }}>

                                            <label class="custom-control-label" for="delete_{{ $menu->id }}"></label>
                                        </div>
                                    </td>

                                </tr>

                                {{-- CHILD MENU --}}
                                @foreach ($menu->children as $child)
                                    @php
                                        $childPermission = $userLevel->menus->where('id', $child->id)->first();
                                    @endphp

                                    <tr>

                                        <td class="pl-5 align-middle small text-gray-600">
                                            <i class="fas fa-angle-right text-muted mr-2"></i>
                                            {{ $child->name }}
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch d-inline-block">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="view_{{ $child->id }}"
                                                    name="permissions[{{ $child->id }}][can_view]" value="1"
                                                    {{ optional($childPermission)?->pivot?->can_view ? 'checked' : '' }}>

                                                <label class="custom-control-label" for="view_{{ $child->id }}"></label>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch d-inline-block">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="create_{{ $child->id }}"
                                                    name="permissions[{{ $child->id }}][can_create]" value="1"
                                                    {{ optional($childPermission)?->pivot?->can_create ? 'checked' : '' }}>

                                                <label class="custom-control-label"
                                                    for="create_{{ $child->id }}"></label>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch d-inline-block">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="edit_{{ $child->id }}"
                                                    name="permissions[{{ $child->id }}][can_edit]" value="1"
                                                    {{ optional($childPermission)?->pivot?->can_edit ? 'checked' : '' }}>

                                                <label class="custom-control-label" for="edit_{{ $child->id }}"></label>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch d-inline-block">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="delete_{{ $child->id }}"
                                                    name="permissions[{{ $child->id }}][can_delete]" value="1"
                                                    {{ optional($childPermission)?->pivot?->can_delete ? 'checked' : '' }}>

                                                <label class="custom-control-label"
                                                    for="delete_{{ $child->id }}"></label>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center small text-muted py-4">
                                        Belum ada menu
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                    <div class="p-3 border-top bg-white">
                        <button class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">
                            <i class="fas fa-save mr-1"></i>
                            Perbarui Permission
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
