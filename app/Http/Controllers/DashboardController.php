<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Rental;
use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFilms = Film::count();
        $totalCustomers = Customer::count();
        $activeRentals = Rental::where('status', 'borrowed')->count();
        $totalSales = Sale::where('payment_status', 'paid')->sum('total_price');

        $recentRentals = Rental::with(['customer', 'film'])
            ->latest()
            ->take(5)
            ->get();

        $recentSales = Sale::with(['customer', 'film'])
            ->latest()
            ->take(5)
            ->get();

        $lowStockFilms = Film::where('stock', '<', 5)->get();

        return view('dashboard', compact(
            'totalFilms',
            'totalCustomers',
            'activeRentals',
            'totalSales',
            'recentRentals',
            'recentSales',
            'lowStockFilms'
        ));
    }

    public function reports()
    {
        // Logic untuk generate laporan
        return view('reports');
    }
}
