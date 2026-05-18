<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $statistics       = $this->service->statistics();
        $recentBorrowings = $this->service->recentBorrowings();
        $lowStockBooks    = $this->service->lowStockBooks();

        return view('dashboard', compact(
            'statistics',
            'recentBorrowings',
            'lowStockBooks'
        ));
    }
}
