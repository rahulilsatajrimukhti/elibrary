@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2 px-3 small shadow-sm">
                <i class="fas fa-check-circle mr-1"></i>
                {{ session('success') }}
                <button type="button" class="close p-1" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                    Dashboard
                </h1>
                <div class="small text-muted">

                    Selamat datang kembali,
                    {{ auth()->user()->name }}
                </div>
            </div>

            <div class="small text-muted">
                <i class="fas fa-calendar-alt mr-1"></i>
                {{ now()->format('d M Y') }}
            </div>
        </div>

        {{-- STATISTICS --}}
        <div class="row">

            {{-- TOTAL BUKU --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow-sm h-100 py-2 border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Buku
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistics['total_books'] }}
                                </div>
                            </div>
                            <div class="col-auto text-primary">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOTAL ANGGOTA --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow-sm h-100 py-2 border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Anggota
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistics['total_members'] }}
                                </div>
                            </div>
                            <div class="col-auto text-success">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DIPINJAM --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow-sm h-100 py-2 border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Sedang Dipinjam
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistics['borrowed_books'] }}
                                </div>
                            </div>
                            <div class="col-auto text-warning">
                                <i class="fas fa-book-reader fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TERLAMBAT --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow-sm h-100 py-2 border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Terlambat
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistics['overdue_books'] }}
                                </div>
                            </div>
                            <div class="col-auto text-danger">
                                <i class="fas fa-exclamation-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- CONTENT --}}
        <div class="row">

            {{-- TRANSAKSI TERBARU --}}
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="m-0 font-weight-bold text-gray-800">
                            Transaksi Terbaru
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm mb-0">
                            <thead class="bg-light">
                                <tr class="small text-muted text-center">
                                    <th>#</th>

                                    <th class="text-left">
                                        Anggota
                                    </th>

                                    <th class="text-left">
                                        Buku
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($recentBorrowings as $key => $row)
                                    <tr>
                                        <td class="text-center small">
                                            {{ $key + 1 }}
                                        </td>

                                        <td class="small">
                                            {{ $row->member->name }}
                                        </td>

                                        <td class="small">
                                            {{ $row->book->title }}
                                        </td>

                                        <td class="text-center">
                                            @if ($row->status == 'borrowed')
                                                <span class="badge badge-warning badge-pill">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="badge badge-success badge-pill">
                                                    Kembali
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-center small">
                                            {{ $row->borrowed_at->format('d M Y') }}
                                        </td>
                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center small text-muted py-3">
                                            Belum ada transaksi
                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- STOCK MENIPIS --}}
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="m-0 font-weight-bold text-gray-800">
                            Stock Hampir Habis
                        </h6>
                    </div>

                    <div class="card-body">
                        @forelse($lowStockBooks as $book)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="small font-weight-bold text-gray-800">
                                        {{ $book->title }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $book->author->name ?? '-' }}
                                    </div>
                                </div>
                                <span class="badge badge-danger badge-pill px-3">
                                    {{ $book->stock }}
                                </span>
                            </div>

                        @empty

                            <div class="text-center text-muted small py-3">
                                Semua stock masih aman
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
