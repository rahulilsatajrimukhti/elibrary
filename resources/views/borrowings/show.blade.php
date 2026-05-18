@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')

    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('borrowings.index') }}" class="btn btn-light btn-sm rounded-circle mr-2 shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h5 class="mb-0 font-weight-bold text-gray-800">
                    Detail Peminjaman
                </h5>
            </div>

            @if (canAccess('borrowings.index', 'can_edit') && $borrowing->status == 'borrowed')
                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST"
                    onsubmit="return confirm('Kembalikan buku ini?')">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm">
                        <i class="fas fa-undo mr-1"></i>
                        Kembalikan Buku
                    </button>
                </form>
            @endif
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
                    <div>

                        <div class="small text-muted mb-1">
                            Kode Transaksi
                        </div>

                        <h4 class="font-weight-bold text-gray-800 mb-2">
                            {{ $borrowing->borrowing_code }}
                        </h4>

                        <div class="text-muted small">
                            Diproses oleh :
                            <strong>
                                {{ $borrowing->staff->name ?? '-' }}
                            </strong>
                        </div>

                    </div>

                    <div>
                        @if ($borrowing->status == 'borrowed')
                            <span class="badge badge-warning badge-pill px-4 py-2">
                                Dipinjam
                            </span>
                        @else
                            <span class="badge badge-success badge-pill px-4 py-2">
                                Dikembalikan
                            </span>
                        @endif
                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="small text-uppercase text-muted mb-3">
                            Informasi Anggota
                        </div>

                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="140" class="text-muted">
                                    Nama
                                </td>
                                <td>
                                    <strong>
                                        {{ $borrowing->member->name }}
                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-muted">
                                    Email
                                </td>
                                <td>
                                    {{ $borrowing->member->email ?? '-' }}
                                </td>
                            </tr>
                        </table>

                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="small text-uppercase text-muted mb-3">
                            Informasi Buku
                        </div>

                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="140" class="text-muted">
                                    Judul
                                </td>
                                <td>
                                    <strong>
                                        {{ $borrowing->book->title }}
                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-muted">
                                    Stock Saat Ini
                                </td>
                                <td>

                                    @if ($borrowing->book->stock > 0)
                                        <span class="badge badge-success badge-pill px-3">
                                            {{ $borrowing->book->stock }}
                                        </span>
                                    @else
                                        <span class="badge badge-danger badge-pill px-3">
                                            Kosong
                                        </span>
                                    @endif

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="small text-uppercase text-muted mb-3">
                    Timeline Transaksi
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3 h-100">
                            <div class="small text-muted mb-1">
                                Tanggal Pinjam
                            </div>
                            <div class="font-weight-bold">
                                {{ $borrowing->borrowed_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3 h-100">
                            <div class="small text-muted mb-1">
                                Jatuh Tempo
                            </div>
                            <div class="font-weight-bold">
                                {{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3 h-100">
                            <div class="small text-muted mb-1">
                                Tanggal Kembali
                            </div>
                            <div class="font-weight-bold">
                                @if ($borrowing->returned_at)
                                    {{ $borrowing->returned_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="small text-uppercase text-muted mb-3">
                    Catatan
                </div>

                <div class="border rounded p-3 bg-light">
                    <div class="text-muted" style="line-height:1.9;">
                        {{ $borrowing->notes ?? 'Tidak ada catatan.' }}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
