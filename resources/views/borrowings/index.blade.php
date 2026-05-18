@extends('layouts.app')
@section('title', 'Peminjaman Buku')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 font-weight-bold text-gray-800">
                Peminjaman Buku
            </h5>

            @if (canAccess('borrowings.index', 'can_create'))
                <a href="{{ route('borrowings.create') }}" class="btn-add-borrow">
                    <i class="fas fa-plus"></i>
                    <span class="btn-text">Peminjaman</span>
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
                            <th>Kode</th>
                            <th class="text-left">Anggota</th>
                            <th class="text-left">Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $key => $row)
                            <tr>
                                <td class="text-center small">
                                    {{ $key + 1 }}
                                </td>

                                <td class="text-center small">
                                    {{ $row->borrowing_code }}
                                </td>

                                <td class="small">
                                    {{ $row->member->name }}
                                </td>

                                <td class="small">
                                    {{ $row->book->title }}
                                </td>

                                <td class="text-center small">
                                    {{ $row->borrowed_at->format('d M Y') }}
                                </td>

                                <td class="text-center small">
                                    {{ \Carbon\Carbon::parse($row->due_date)->format('d M Y') }}
                                </td>

                                <td class="text-center">
                                    @if ($row->status == 'borrowed')
                                        <span class="badge badge-pill text-black badge-warning">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-success">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if (canAccess('borrowings.index', 'can_view'))
                                        <a href="{{ route('borrowings.show', $row->id) }}"
                                            class="btn btn-info btn-sm rounded-circle">

                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif

                                    @if (canAccess('borrowings.index', 'can_edit') && $row->status == 'borrowed')
                                        <form action="{{ route('borrowings.return', $row->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Kembalikan buku ini?')">

                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-success btn-sm rounded-circle">
                                                <i class="fas fa-undo"></i>
                                            </button>

                                        </form>
                                    @endif
                                </td>
                            </tr>

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
