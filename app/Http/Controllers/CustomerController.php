<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(12);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('customers', 'public');
            $data['photo'] = $photoPath;
        }

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:customers,email,'.$customer->id,
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Jika ada file foto baru
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($customer->photo) {
            Storage::disk('public')->delete($customer->photo);
        }

        // Simpan foto baru
        $photoPath = $request->file('photo')->store('customers', 'public');
        $validated['photo'] = $photoPath;
    }

    // Update customer
    $customer->update($validated);

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
}

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
