<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $order->load('user', 'orderItems.product');

        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string',
        ]);

        // If order is being cancelled and was not cancelled before, restore inventory
        if ($validated['status'] === 'cancelled' && $order->status !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment('quantity', $item->quantity);
                }
            }
        }

        // If order was cancelled and is being reactivated, reduce inventory
        if ($order->status === 'cancelled' && $validated['status'] !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    // Check if enough stock is available
                    if ($item->product->quantity < $item->quantity) {
                        return redirect()->back()
                            ->with('error', __('admin.insufficient_stock', ['product' => $item->product_name]));
                    }
                    $item->product->decrement('quantity', $item->quantity);
                }
            }
        }

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.order')]));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        // If order is being cancelled and was not cancelled before, restore inventory
        if ($validated['status'] === 'cancelled' && $order->status !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment('quantity', $item->quantity);
                }
            }
        }

        // If order was cancelled and is being reactivated, reduce inventory
        if ($order->status === 'cancelled' && $validated['status'] !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    // Check if enough stock is available
                    if ($item->product->quantity < $item->quantity) {
                        return redirect()->back()
                            ->with('error', __('admin.insufficient_stock', ['product' => $item->product_name]));
                    }
                    $item->product->decrement('quantity', $item->quantity);
                }
            }
        }

        $order->update(['status' => $validated['status']]);

        return redirect()->back()
            ->with('success', __('admin.status_updated_successfully'));
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        // Restore inventory if order is not cancelled
        if ($order->status !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment('quantity', $item->quantity);
                }
            }
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.order')]));
    }
}
