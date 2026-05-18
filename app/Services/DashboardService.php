<?php

namespace App\Services;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class DashboardService
{
    public function statistics(): array
    {
        return [

            'total_books' => Book::count(),

            'total_members' => User::whereHas('userLevel', function ($query) {
                $query->where(
                    'name',
                    'Anggota Perpustakaan'
                );
            })->count(),

            'borrowed_books' => Borrowing::where(
                'status',
                'borrowed'
            )->count(),

            'overdue_books' => Borrowing::where(function ($query) {

                $query->where(function ($q) {

                    $q->where('status', 'borrowed')
                        ->whereDate('due_date', '<', now());
                })->orWhere(function ($q) {

                    $q->whereNotNull('returned_at')
                        ->whereColumn('returned_at', '>', 'due_date');
                });
            })->count(),
        ];
    }

    public function recentBorrowings()
    {
        return Borrowing::with([
            'book',
            'member',
        ])
            ->latest()
            ->take(5)
            ->get();
    }

    public function lowStockBooks()
    {
        return Book::where('stock', '<=', 3)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();
    }
}
