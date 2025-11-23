<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers (storefront users).
     */
    public function index()
    {
        $customers = User::where('is_admin', false)
            ->withCount('orders')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer.
     */
    public function show(User $customer)
    {
        // Ensure the user is a customer
        if ($customer->is_admin) {
            return redirect()->route('admin.customers.index')
                ->with('error', __('admin.customer_not_found'));
        }

        $customer->load('orders');

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(User $customer)
    {
        // Ensure the user is a customer
        if ($customer->is_admin) {
            return redirect()->route('admin.customers.index')
                ->with('error', __('admin.customer_not_found'));
        }

        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, User $customer)
    {
        // Ensure the user is a customer
        if ($customer->is_admin) {
            return redirect()->route('admin.customers.index')
                ->with('error', __('admin.customer_not_found'));
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$customer->id,
            'phone' => 'nullable|string|max:255',
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'] ?? null;
        $customer->save();

        return redirect()->route('admin.customers.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.customer')]));
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(User $customer)
    {
        // Ensure the user is a customer
        if ($customer->is_admin) {
            return redirect()->route('admin.customers.index')
                ->with('error', __('admin.customer_not_found'));
        }

        // Prevent deleting customers with orders
        if ($customer->orders()->count() > 0) {
            return redirect()->route('admin.customers.index')
                ->with('error', __('admin.cannot_delete_customer_with_orders'));
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.customer')]));
    }
}
