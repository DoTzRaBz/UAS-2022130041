<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Film;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'film'])->latest()->get();

        $totalCustomers = Customer::count();
        $totalRevenue = Sale::sum('total_price');
        $totalSales = Sale::count();
        $averageRevenue = $totalSales > 0 ? $totalRevenue / $totalSales : 0;

        return view('sales.index', compact('sales', 'totalCustomers', 'totalRevenue', 'totalSales', 'averageRevenue'));
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
