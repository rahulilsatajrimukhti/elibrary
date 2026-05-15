@extends('layouts.app')
@section('title', 'Permission User Level')

@section('content')

    <div class="container-fluid permission-page">

        {{-- PAGE HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-3">

            <div class="d-flex align-items-center">

                <a href="{{ route('user-levels.index') }}" class="btn btn-light btn-sm rounded-circle shadow-sm mr-2">

                    <i class="fas fa-arrow-left"></i>
                </a>

                <div>
                    <h5 class="mb-0 font-weight-bold text-gray-800">
                        Permission User Level | {{ $userLevel->name }}
                    </h5>
                </div>

            </div>

        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">

                <i class="fas fa-check-circle mr-1"></i>
                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert">

                    <span>&times;</span>
                </button>

            </div>
        @endif

        {{-- CARD --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <form method="POST" action="{{ route('user-levels.permissions.update', $userLevel->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0 permission-table">

                            {{-- TABLE HEADER --}}
                            <thead>

                                <tr class="text-center small text-muted">

                                    <th class="text-left pl-4">
                                        Menu
                                    </th>

                                    <th width="90">

                                        <div class="custom-control custom-switch d-inline-block">

                                            <input type="checkbox" class="custom-control-input" id="check_all_view">

                                            <label class="custom-control-label" for="check_all_view">

                                                View
                                            </label>

                                        </div>

                                    </th>

                                    <th width="90">

                                        <div class="custom-control custom-switch d-inline-block">

                                            <input type="checkbox" class="custom-control-input" id="check_all_create">

                                            <label class="custom-control-label" for="check_all_create">

                                                Create
                                            </label>

                                        </div>

                                    </th>

                                    <th width="90">

                                        <div class="custom-control custom-switch d-inline-block">

                                            <input type="checkbox" class="custom-control-input" id="check_all_edit">

                                            <label class="custom-control-label" for="check_all_edit">

                                                Edit
                                            </label>

                                        </div>

                                    </th>

                                    <th width="90">

                                        <div class="custom-control custom-switch d-inline-block">

                                            <input type="checkbox" class="custom-control-input" id="check_all_delete">

                                            <label class="custom-control-label" for="check_all_delete">

                                                Delete
                                            </label>

                                        </div>

                                    </th>

                                </tr>

                            </thead>

                            {{-- TABLE BODY --}}
                            <tbody>

                                @forelse($menus as $menu)

                                    @php
                                        $permission = $userLevel->menus->where('id', $menu->id)->first();
                                    @endphp

                                    {{-- PARENT MENU --}}
                                    <tr class="permission-parent">

                                        <td class="pl-4 font-weight-bold text-gray-700">

                                            <i class="fas fa-folder-open text-primary mr-2"></i>

                                            {{ $menu->name }}

                                        </td>

                                        {{-- VIEW --}}
                                        <td class="text-center">

                                            <div class="custom-control custom-switch d-inline-block">

                                                <input type="checkbox" class="custom-control-input permission-view"
                                                    id="view_{{ $menu->id }}"
                                                    name="permissions[{{ $menu->id }}][can_view]" value="1"
                                                    {{ optional($permission)?->pivot?->can_view ? 'checked' : '' }}>

                                                <label class="custom-control-label" for="view_{{ $menu->id }}"></label>

                                            </div>

                                        </td>

                                        {{-- CREATE --}}
                                        <td class="text-center">

                                            @if ($menu->children->count() == 0)
                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-create"
                                                        id="create_{{ $menu->id }}"
                                                        name="permissions[{{ $menu->id }}][can_create]" value="1"
                                                        {{ optional($permission)?->pivot?->can_create ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="create_{{ $menu->id }}"></label>

                                                </div>
                                            @else
                                                <span class="permission-empty">—</span>
                                            @endif

                                        </td>

                                        {{-- EDIT --}}
                                        <td class="text-center">

                                            @if ($menu->children->count() == 0)
                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-edit"
                                                        id="edit_{{ $menu->id }}"
                                                        name="permissions[{{ $menu->id }}][can_edit]" value="1"
                                                        {{ optional($permission)?->pivot?->can_edit ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="edit_{{ $menu->id }}"></label>

                                                </div>
                                            @else
                                                <span class="permission-empty">—</span>
                                            @endif

                                        </td>

                                        {{-- DELETE --}}
                                        <td class="text-center">

                                            @if ($menu->children->count() == 0)
                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-delete"
                                                        id="delete_{{ $menu->id }}"
                                                        name="permissions[{{ $menu->id }}][can_delete]" value="1"
                                                        {{ optional($permission)?->pivot?->can_delete ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="delete_{{ $menu->id }}"></label>

                                                </div>
                                            @else
                                                <span class="permission-empty">—</span>
                                            @endif

                                        </td>

                                    </tr>

                                    {{-- CHILD MENU --}}
                                    @foreach ($menu->children as $child)
                                        @php
                                            $childPermission = $userLevel->menus->where('id', $child->id)->first();
                                        @endphp

                                        <tr>

                                            <td class="pl-5 text-gray-600">

                                                <i class="fas fa-angle-right text-muted mr-2"></i>

                                                {{ $child->name }}

                                            </td>

                                            {{-- VIEW --}}
                                            <td class="text-center">

                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-view"
                                                        id="view_{{ $child->id }}"
                                                        name="permissions[{{ $child->id }}][can_view]" value="1"
                                                        {{ optional($childPermission)?->pivot?->can_view ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="view_{{ $child->id }}"></label>

                                                </div>

                                            </td>

                                            {{-- CREATE --}}
                                            <td class="text-center">

                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-create"
                                                        id="create_{{ $child->id }}"
                                                        name="permissions[{{ $child->id }}][can_create]"
                                                        value="1"
                                                        {{ optional($childPermission)?->pivot?->can_create ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="create_{{ $child->id }}"></label>

                                                </div>

                                            </td>

                                            {{-- EDIT --}}
                                            <td class="text-center">

                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-edit"
                                                        id="edit_{{ $child->id }}"
                                                        name="permissions[{{ $child->id }}][can_edit]" value="1"
                                                        {{ optional($childPermission)?->pivot?->can_edit ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="edit_{{ $child->id }}"></label>

                                                </div>

                                            </td>

                                            {{-- DELETE --}}
                                            <td class="text-center">

                                                <div class="custom-control custom-switch d-inline-block">

                                                    <input type="checkbox" class="custom-control-input permission-delete"
                                                        id="delete_{{ $child->id }}"
                                                        name="permissions[{{ $child->id }}][can_delete]"
                                                        value="1"
                                                        {{ optional($childPermission)?->pivot?->can_delete ? 'checked' : '' }}>

                                                    <label class="custom-control-label"
                                                        for="delete_{{ $child->id }}"></label>

                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center py-5 text-muted">

                                            Belum ada menu

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    {{-- FOOTER --}}
                    <div class="p-3 border-top bg-white text-right">

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
