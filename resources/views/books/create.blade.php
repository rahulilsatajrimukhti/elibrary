@extends('layouts.app')
@section('title', 'Tambah Buku')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex align-items-center mb-3">

            <a href="{{ route('books.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">

                <i class="fas fa-arrow-left"></i>
            </a>

            <h5 class="mb-0 font-weight-bold text-gray-800">
                Tambah Buku
            </h5>

        </div>

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- LEFT --}}
                        <div class="col-md-8">

                            {{-- JUDUL --}}
                            <div class="form-group mb-3">
                                <label class="small text-muted">
                                    Judul Buku
                                </label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control form-control-sm rounded-pill px-3 @error('title') is-invalid @enderror">

                                @error('title')
                                    <div class="text-danger small mt-1 ml-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">

                                {{-- KATEGORI --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">
                                            Kategori
                                        </label>
                                        <select name="category_id"
                                            class="form-control form-control-sm rounded-pill px-3 @error('category_id') is-invalid @enderror">
                                            <option value="">
                                                -- Pilih Kategori --
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- PENULIS --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">
                                            Penulis
                                        </label>
                                        <select name="author_id"
                                            class="form-control form-control-sm rounded-pill px-3 @error('author_id') is-invalid @enderror">
                                            <option value="">
                                                -- Pilih Penulis --
                                            </option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}"
                                                    {{ old('author_id') == $author->id ? 'selected' : '' }}>

                                                    {{ $author->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                {{-- PENERBIT --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">
                                            Penerbit
                                        </label>
                                        <select name="publisher_id"
                                            class="form-control form-control-sm rounded-pill px-3 @error('publisher_id') is-invalid @enderror">
                                            <option value="">
                                                -- Pilih Penerbit --
                                            </option>
                                            @foreach ($publishers as $publisher)
                                                <option value="{{ $publisher->id }}"
                                                    {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>

                                                    {{ $publisher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('publisher_id')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- TAHUN --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">
                                            Tahun Terbit
                                        </label>
                                        <input type="number" name="publish_year" value="{{ old('publish_year') }}"
                                            class="form-control form-control-sm rounded-pill px-3 @error('publish_year') is-invalid @enderror">

                                        @error('publish_year')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                {{-- ISBN --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">
                                            ISBN
                                        </label>
                                        <input type="text" name="isbn" value="{{ old('isbn') }}"
                                            class="form-control form-control-sm rounded-pill px-3 @error('isbn') is-invalid @enderror">
                                        @error('isbn')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- STOCK --}}
                                <div class="col-md-6">

                                    <div class="form-group mb-3">

                                        <label class="small text-muted">
                                            Stock
                                        </label>

                                        <input type="number" name="stock" value="{{ old('stock', 0) }}"
                                            class="form-control form-control-sm rounded-pill px-3 @error('stock') is-invalid @enderror">

                                        @error('stock')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="form-group mb-3">
                                <label class="small text-muted">
                                    Deskripsi
                                </label>
                                <textarea name="description" rows="6" placeholder="Masukkan deskripsi buku..."
                                    class="form-control form-control-sm rounded @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger small mt-1 ml-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-4">

                            {{-- COVER --}}
                            <div class="card border shadow-sm">

                                <div class="card-body">

                                    <label class="small text-muted d-block">
                                        Cover Buku
                                    </label>

                                    <div id="coverContainer"
                                        class="border rounded bg-light d-flex align-items-center justify-content-center shadow-sm mb-3"
                                        style="height:250px; overflow:hidden;">

                                        {{-- EMPTY STATE --}}
                                        <div id="emptyCover" class="text-center">

                                            <i class="fas fa-book fa-3x text-secondary mb-2"></i>

                                            <div class="small text-muted">
                                                Preview Cover
                                            </div>

                                        </div>

                                        {{-- PREVIEW --}}
                                        <img id="coverPreview" class="img-fluid rounded d-none"
                                            style="max-height:250px; object-fit:cover; cursor:pointer; transition:.2s ease;">

                                    </div>

                                    <input type="file" name="cover" accept="image/*"
                                        class="form-control-file @error('cover') is-invalid @enderror">

                                    @error('cover')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            {{-- STATUS --}}
                            <div class="card border shadow-sm mt-3">
                                <div class="card-body">
                                    <label class="small text-muted d-block mb-2">
                                        Status
                                    </label>
                                    <input type="hidden" name="is_active" value="0">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_active" value="1"
                                            class="custom-control-input" id="statusSwitch"
                                            {{ old('is_active', 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label small" for="statusSwitch">
                                            Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="pt-3 mt-4 d-flex">
                        <button class="btn btn-primary btn-sm rounded-pill px-4 mr-2 shadow-sm">
                            <i class="fas fa-save mr-1"></i>
                            Simpan
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-light btn-sm rounded-pill px-4">
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
