<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Film;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
{
    // Query dasar dengan eager loading
    $query = Sale::with(['customer', 'film']);

    // Filter berdasarkan payment status
    if ($request->has('payment_status') && $request->payment_status != '') {
        $query->where('payment_status', $request->payment_status);
    }

    // Global search
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->whereHas('customer', function($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('film', function($subQuery) use ($search) {
                $subQuery->where('title', 'like', "%{$search}%");
            })
            ->orWhere('total_price', 'like', "%{$search}%");
        });
    }

    // Sorting
    $sortField = $request->get('sort', 'created_at');
    $sortDirection = $request->get('direction', 'desc');

    // Validasi kolom sorting
    $allowedSorts = ['created_at', 'total_price', 'quantity'];
    $sortField = in_array($sortField, $allowedSorts) ? $sortField : 'created_at';

    $query->orderBy($sortField, $sortDirection);

    // Pagination dengan appends
    $sales = $query->paginate(10)->appends($request->query());

    // Statistik
    $totalCustomers = Customer::count();
    $totalRevenue = Sale::sum('total_price');
    $totalSales = Sale::count();
    $averageRevenue = $totalSales > 0 ? $totalRevenue / $totalSales : 0;

    // Ambil distinct values untuk filter
    $paymentStatuses = Sale::distinct('payment_status')->pluck('payment_status');

    return view('sales.index', compact(
        'sales',
        'totalCustomers',
        'totalRevenue',
        'totalSales',
        'averageRevenue',
        'paymentStatuses'
    ));
}
    public function create()
    {
        $customers = Customer::all();
        $films = Film::where('stock', '>', 0)->get();
        return view('sales.create', compact('customers', 'films'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'film_id' => 'required|exists:films,id',
            'quantity' => 'required|numeric|min:1',
            'payment_status' => 'required|in:pending,paid,cancelled'
        ]);

        $film = Film::find($request->film_id);

        // Validasi stok
        if ($film->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock');
        }

        // Hitung total harga
        $validated['total_price'] = $film->price * $request->quantity;

        // Buat transaksi
        $sale = Sale::create($validated);

        // Kurangi stok film
        $film->decrement('stock', $request->quantity);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $films = Film::where('stock', '>', 0)->get();
        return view('sales.edit', compact('sale', 'customers', 'films'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'film_id' => 'required|exists:films,id',
            'quantity' => 'required|numeric|min:1',
            'payment_status' => 'required|in:pending,paid,cancelled'
        ]);

        // Jika ada perubahan quantity
        if ($sale->quantity != $request->quantity) {
            $film = Film::find($request->film_id);

            // Kembalikan stok lama
            $film->increment('stock', $sale->quantity);

            // Validasi stok baru
            if ($film->stock < $request->quantity) {
                $film->decrement('stock', $sale->quantity); // Kembalikan ke kondisi semula
                return back()->with('error', 'Insufficient stock');
            }

            // Kurangi dengan stok baru
            $film->decrement('stock', $request->quantity);

            // Update total price
            $validated['total_price'] = $film->price * $request->quantity;
        }

        $sale->update($validated);
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully');
    }

    public function destroy(Sale $sale)
    {
        // Jika status pembayaran bukan cancelled, kembalikan stok
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully');

        if ($sale->payment_status !== 'cancelled') {
            $sale->film->increment('stock', $sale->quantity);
        }

        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully');
    }

    public function updatePaymentStatus(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,cancelled'
        ]);

        $sale->update($validated);

        return redirect()->route('sales.index')
            ->with('success', 'Payment status updated successfully');
    }
}
