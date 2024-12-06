<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Film;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['customer', 'film'])->latest()->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $customers = Customer::all();
        $films = Film::where('stock', '>', 0)->get();
        return view('rentals.create', compact('customers', 'films'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'film_id' => 'required|exists:films,id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after:rental_date',
        ]);

        $film = Film::findOrFail($request->film_id);

        // Gunakan method isAvailable dari model
        if (!$film->isAvailable()) {
            return back()->with('error', 'Film is out of stock!');
        }

        DB::beginTransaction();
        try {
            // Kurangi stok film
            $film->reduceStock();

            // Calculate rental fee based on number of days
            $rentalDate = Carbon::parse($request->rental_date);
            $returnDate = Carbon::parse($request->return_date);
            $days = $rentalDate->diffInDays($returnDate);
            $rentalFee = $film->rental_price * $days;

            // Create rental
            $rental = Rental::create([
                'customer_id' => $request->customer_id,
                'film_id' => $request->film_id,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
                'rental_fee' => $rentalFee,
                'status' => 'ongoing'
            ]);

            Sale::create([
                'customer_id' => $request->customer_id,
                'film_id' => $request->film_id,
                'quantity' => 1,
                'total_price' => $rentalFee,
                'payment_status' => 'pending',
                'status' => 'ongoing',
                'rental_id' => $rental->id
            ]);

            DB::commit();

            return redirect()->route('rentals.index')->with('success', 'Rental created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Rental creation error: ' . $e->getMessage());
            return back()->with('error', 'Failed to create rental. Please try again.');
        }
    }

    public function processReturn(Rental $rental)
{
    if ($rental->status === 'returned') {
        return redirect()->route('rentals.index')
            ->with('error', 'This rental has already been returned.');
    }

    DB::beginTransaction();
    try {
        $today = Carbon::today();
        $lateFee = 0;

        // Hitung denda keterlambatan
        if ($today->isAfter($rental->return_date)) {
            $daysLate = $today->diffInDays($rental->return_date);
            $lateFee = $daysLate * ($rental->film->rental_price * 0.1);
        }

        $rental->update([
            'actual_return_date' => $today,
            'late_fee' => $lateFee,
            'status' => 'returned'
        ]);

        // Update related sale
        if ($rental->sale) {
            $rental->sale->update([
                'status' => 'paid',
                'payment_status' => 'paid',
                'total_price' => $rental->rental_fee + $lateFee
            ]);
        }

        // Kembalikan stok film
        $rental->film->increaseStock();

        DB::commit();

        return redirect()->route('rentals.index')
            ->with('success', 'Film returned successfully! ' .
                   ($lateFee > 0 ? 'Late fee: $' . number_format($lateFee, 2) : ''));
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Rental return error: ' . $e->getMessage());
        return redirect()->route('rentals.index')
            ->with('error', 'An error occurred while processing the return. Please try again.');
    }
}
}
