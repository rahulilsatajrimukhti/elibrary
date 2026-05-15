@extends('layouts.app')

@section('title', 'Detail Buku')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('books.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                </a>

                <h5 class="mb-0 font-weight-bold text-gray-800">
                    Detail Buku
                </h5>
            </div>

            @if (canAccess('books.index', 'can_edit'))
                <a href="{{ route('books.edit', $data->id) }}" class="btn btn-warning btn-sm rounded-pill px-4 shadow-sm">
                    <i class="fas fa-edit mr-1"></i>
                    Edit Buku
                </a>
            @endif

        </div>

        <div class="row mb-4">

            {{-- COVER --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="text-center mb-3">
                            <img src="{{ $data->cover ? Storage::url($data->cover) : 'https://via.placeholder.com/300x420?text=No+Cover' }}"
                                class="img-fluid rounded shadow-sm border cover-preview"
                                style="max-height:460px; object-fit:cover; cursor:pointer;" data-toggle="modal"
                                data-target="#coverModal">
                        </div>

                        {{-- INFO TAMBAHAN --}}
                        <div class="mt-auto">
                            <hr>

                            <div class="small text-uppercase text-muted mb-2">
                                Informasi Buku
                            </div>

                            <div class="d-flex justify-content-between small mb-2">
                                <span class="text-muted">Dibuat</span>
                                <strong>{{ $data->created_at->format('d M Y') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between small mb-3">
                                <span class="text-muted">Update</span>
                                <strong>{{ $data->updated_at->format('d M Y') }}</strong>
                            </div>

                            <button class="btn btn-outline-primary btn-sm btn-block rounded-pill" data-toggle="modal"
                                data-target="#coverModal">
                                <i class="fas fa-search-plus mr-1"></i>
                                Lihat Cover
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            {{-- DETAIL --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2 class="font-weight-bold text-gray-800 mb-1">
                                    {{ $data->title }}
                                </h2>

                                <div class="text-muted">
                                    ISBN :
                                    {{ $data->isbn ?? '-' }}
                                </div>
                            </div>

                            <span
                                class="badge badge-pill px-3 py-2 {{ $data->is_active ? 'badge-success' : 'badge-secondary' }}">
                                {{ $data->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Kategori</small>
                                <strong>{{ $data->category->name ?? '-' }}</strong>
                            </div>

                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Penulis</small>
                                <strong>{{ $data->author->name ?? '-' }}</strong>
                            </div>

                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Penerbit</small>
                                <strong>{{ $data->publisher->name ?? '-' }}</strong>
                            </div>

                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Tahun Terbit</small>
                                <strong>{{ $data->publish_year ?? '-' }}</strong>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted d-block">Stock</small>

                                @if ($data->stock <= 0)
                                    <span class="badge badge-danger badge-pill px-3">
                                        Kosong
                                    </span>
                                @elseif ($data->stock < 5)
                                    <span class="badge badge-warning badge-pill px-3">
                                        {{ $data->stock }}
                                    </span>
                                @else
                                    <span class="badge badge-success badge-pill px-3">
                                        {{ $data->stock }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-gray-700 mb-3">
                            Deskripsi
                        </h6>

                        <div class="text-muted" style="line-height: 1.9;">
                            {{ $data->description ?? 'Tidak ada deskripsi.' }}
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- MODAL COVER --}}
    <div class="modal fade" id="coverModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-body p-2 text-center bg-dark">
                    <img src="{{ $data->cover ? Storage::url($data->cover) : 'https://via.placeholder.com/300x420?text=No+Cover' }}"
                        class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

@endsection
