@extends('layouts.app')
@section('title', 'Buku')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 font-weight-bold text-gray-800">
                Buku
            </h5>

            @if (canAccess('books.index', 'can_create'))
                <a href="{{ route('books.create') }}" class="btn-add-user">
                    <i class="fas fa-plus"></i>
                    <span class="btn-text">Buku</span>
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
                            <th width="70">Cover</th>
                            <th class="text-left">Judul</th>
                            <th class="text-left">Kategori</th>
                            <th class="text-left">Penulis</th>
                            <th class="text-left">Penerbit</th>
                            <th width="90">Stock</th>
                            <th width="90">Status</th>

                            @if (canAccess('books.index', 'can_edit') || canAccess('books.index', 'can_delete'))
                                <th width="150">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($data as $key => $row)
                            <tr>

                                <td class="text-center small align-middle">
                                    {{ $key + 1 }}
                                </td>

                                {{-- COVER --}}
                                <td class="text-center align-middle">

                                    @if ($row->cover)
                                        <img src="{{ Storage::url($row->cover) }}" width="45" height="60"
                                            class="rounded shadow-sm border book-cover-preview"
                                            style="object-fit: cover; cursor:pointer;" data-toggle="modal"
                                            data-target="#coverModal{{ $row->id }}">

                                        {{-- MODAL --}}
                                        <div class="modal fade" id="coverModal{{ $row->id }}" tabindex="-1">

                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">

                                                    <div class="modal-body p-2 text-center bg-dark">

                                                        <img src="{{ Storage::url($row->cover) }}"
                                                            class="img-fluid rounded shadow">

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto border"
                                            style="width:45px; height:60px;">

                                            <i class="fas fa-book text-secondary"></i>

                                        </div>
                                    @endif

                                </td>

                                {{-- JUDUL --}}
                                <td class="small align-middle font-weight-bold text-gray-700">
                                    {{ $row->title }}

                                    @if ($row->isbn)
                                        <div class="text-muted small">
                                            ISBN : {{ $row->isbn }}
                                        </div>
                                    @endif
                                </td>

                                {{-- KATEGORI --}}
                                <td class="small align-middle">
                                    {{ $row->category->name ?? '-' }}
                                </td>

                                {{-- PENULIS --}}
                                <td class="small align-middle">
                                    {{ $row->author->name ?? '-' }}
                                </td>

                                {{-- PENERBIT --}}
                                <td class="small align-middle">
                                    {{ $row->publisher->name ?? '-' }}
                                </td>

                                {{-- STOCK --}}
                                <td class="text-center align-middle">

                                    @if ($row->stock <= 0)
                                        <span class="badge badge-danger badge-pill px-3">
                                            Kosong
                                        </span>
                                    @elseif ($row->stock < 5)
                                        <span class="badge badge-warning badge-pill px-3">
                                            {{ $row->stock }}
                                        </span>
                                    @else
                                        <span class="badge badge-success badge-pill px-3">
                                            {{ $row->stock }}
                                        </span>
                                    @endif

                                </td>

                                {{-- STATUS --}}
                                <td class="text-center align-middle">
                                    <span
                                        class="badge badge-pill {{ $row->is_active ? 'badge-success' : 'badge-secondary' }}">

                                        {{ $row->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                @if (canAccess('books.index', 'can_edit') || canAccess('books.index', 'can_delete'))
                                    <td class="text-center align-middle">

                                        @if (canAccess('books.index', 'can_edit'))
                                            <a href="{{ route('books.edit', $row->id) }}"
                                                class="btn btn-warning btn-sm rounded-circle">

                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif

                                        @if (canAccess('books.index', 'can_delete'))
                                            <form action="{{ route('books.destroy', $row->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus buku ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm rounded-circle">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </td>
                                @endif

                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center small text-muted py-4">
                                    Belum ada data buku
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
