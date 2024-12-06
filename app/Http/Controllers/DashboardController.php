<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Film;
use App\Models\Customer;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
{
    // Ambil data dari Sale Controller
    $totalCustomers = Customer::count();

    // Hanya hitung sales yang sudah dibayar
    $totalRevenue = Sale::where('payment_status', 'paid')->sum('total_price');
    $totalSales = Sale::where('payment_status', 'paid')->count();

    $averageRevenue = $totalSales > 0 ? $totalRevenue / $totalSales : 0;

    // Tambahan data untuk dashboard
    $totalFilms = Film::count();
    $activeRentals = Rental::where('status', 'ongoing')->count();

    return view('dashboard', [
        'totalCustomers' => $totalCustomers,
        'totalRevenue' => $totalRevenue,
        'totalSales' => $totalSales,
        'averageRevenue' => $averageRevenue,
        'totalFilms' => $totalFilms,
        'activeRentals' => $activeRentals
    ]);
}
}
