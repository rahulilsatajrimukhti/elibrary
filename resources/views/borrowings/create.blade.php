@extends('layouts.app')
@section('title', 'Tambah Peminjaman')

@section('content')

    <div class="container-fluid">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('borrowings.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h5 class="mb-0 font-weight-bold text-gray-800">
                Tambah Peminjaman
            </h5>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">

                            <div class="form-group mb-3">
                                <label class="small text-muted">
                                    Anggota
                                </label>
                                <select name="member_id"
                                    class="form-control form-control-sm rounded-pill px-3 @error('member_id') is-invalid @enderror">

                                    <option value="">
                                        -- Pilih Anggota --
                                    </option>

                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}"
                                            {{ old('member_id') == $member->id ? 'selected' : '' }}>

                                            {{ $member->name }}

                                        </option>
                                    @endforeach

                                </select>
                                @error('member_id')
                                    <div class="text-danger small mt-1 ml-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-group mb-3">
                                <label class="small text-muted">
                                    Buku
                                </label>
                                <select name="book_id"
                                    class="form-control form-control-sm rounded-pill px-3 @error('book_id') is-invalid @enderror">
                                    <option value="">
                                        -- Pilih Buku --
                                    </option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}"
                                            {{ old('book_id') == $book->id ? 'selected' : '' }}>

                                            {{ $book->title }}
                                            (Stock: {{ $book->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <div class="text-danger small mt-1 ml-2">

                                        <i class="fas fa-exclamation-circle mr-1"></i>

                                        {{ $message }}

                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">
                                            Tanggal Pinjam
                                        </label>
                                        <input type="date" name="borrowed_at"
                                            value="{{ old('borrowed_at', now()->format('Y-m-d')) }}"
                                            class="form-control form-control-sm rounded-pill px-3 @error('borrowed_at') is-invalid @enderror">
                                        @error('borrowed_at')
                                            <div class="text-danger small mt-1 ml-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- JATUH TEMPO --}}
                                <div class="col-md-6">

                                    <div class="form-group mb-3">

                                        <label class="small text-muted">
                                            Jatuh Tempo
                                        </label>

                                        <input type="date" name="due_date" value="{{ old('due_date') }}"
                                            class="form-control form-control-sm rounded-pill px-3 @error('due_date') is-invalid @enderror">

                                        @error('due_date')
                                            <div class="text-danger small mt-1 ml-2">

                                                <i class="fas fa-exclamation-circle mr-1"></i>

                                                {{ $message }}

                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                            <div class="form-group mb-3">
                                <label class="small text-muted">
                                    Catatan
                                </label>
                                <textarea name="notes" rows="5" placeholder="Masukkan catatan..."
                                    class="form-control form-control-sm rounded @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="text-danger small mt-1 ml-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="card border shadow-sm">

                                <div class="card-body">
                                    <label class="small text-muted d-block mb-3">
                                        Informasi
                                    </label>
                                    <div class="small text-muted mb-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Pastikan buku tersedia sebelum dipinjam.
                                    </div>
                                    <div class="small text-muted mb-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Stock otomatis berkurang saat transaksi dibuat.
                                    </div>
                                    <div class="small text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Buku dapat dikembalikan melalui menu transaksi.
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="pt-3 mt-4 d-flex">
                        <button class="btn btn-primary btn-sm rounded-pill px-4 mr-2 shadow-sm">
                            <i class="fas fa-save mr-1"></i>
                            Simpan
                        </button>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-light btn-sm rounded-pill px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
