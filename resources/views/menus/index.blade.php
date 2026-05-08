@extends('layouts.app')
@section('title', 'Menu')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 font-weight-bold text-gray-800">
                Menu
            </h5>

            @if (canAccess('user-levels.index', 'can_create'))
                <a href="{{ route('menus.create') }}" class="btn-add-menu">
                    <i class="fas fa-plus"></i>
                    <span class="btn-text">Menu</span>
                </a>
            @endif
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
                <table class="table table-sm mb-0">
                    <thead class="bg-light">
                        <tr class="small text-muted text-center">
                            <th width="50">#</th>
                            <th class="text-left">Nama</th>
                            <th class="text-left">Route</th>
                            <th class="text-left">Icon</th>
                            <th class="text-left">Menu Utama</th>
                            <th class="text-left">Urutan</th>
                            <th width="100">Status</th>
                            @if (canAccess('menus.index', 'can_create'))
                                <th width="100">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($data as $key => $row)

                            <tr class="bg-light">

                                <td class="text-center small">
                                    {{ $key + 1 }}
                                </td>

                                <td class="small font-weight-bold text-gray-700">
                                    <i class="fas fa-folder-open text-primary mr-2"></i>
                                    {{ $row->name }}
                                </td>

                                <td class="small">
                                    {{ $row->route ?? '-' }}
                                </td>

                                <td class="small">
                                    {{ $row->icon ?? '-' }}
                                </td>

                                <td class="small">
                                    -
                                </td>

                                <td class="small">
                                    {{ $row->order }}
                                </td>

                                <td class="text-center">
                                    <span
                                        class="badge badge-pill {{ $row->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $row->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    @if (canAccess('menus.index', 'can_edit'))
                                        <a href="{{ route('menus.edit', $row->id) }}"
                                            class="btn btn-warning btn-sm rounded-circle">

                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if (canAccess('menus.index', 'can_delete'))
                                        <form action="{{ route('menus.destroy', $row->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm rounded-circle">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                </td>

                            </tr>

                            @foreach ($row->children as $child)
                                <tr>

                                    <td></td>

                                    <td class="small pl-5 text-gray-600">
                                        <i class="fas fa-angle-right text-muted mr-2"></i>
                                        {{ $child->name }}
                                    </td>

                                    <td class="small">
                                        {{ $child->route ?? '-' }}
                                    </td>

                                    <td class="small">
                                        {{ $child->icon ?? '-' }}
                                    </td>

                                    <td class="small">
                                        {{ $row->name }}
                                    </td>

                                    <td class="small">
                                        {{ $child->order }}
                                    </td>

                                    <td class="text-center">
                                        <span
                                            class="badge badge-pill {{ $child->is_active ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        @if (canAccess('menus.index', 'can_edit'))
                                            <a href="{{ route('menus.edit', $child->id) }}"
                                                class="btn btn-warning btn-sm rounded-circle">

                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif

                                        @if (canAccess('menus.index', 'can_delete'))
                                            <form action="{{ route('menus.destroy', $child->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm rounded-circle">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        @empty

                            <tr>
                                <td colspan="8" class="text-center small text-muted py-3">

                                    Belum ada data
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
