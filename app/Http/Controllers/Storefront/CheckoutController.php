<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected CartService $cartService;

    protected OrderService $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', __('storefront.cart_empty'));
        }

        $subtotal = $this->cartService->getTotal();
        $tax = $subtotal * 0.1; // 10% tax
        $shipping = 10; // Flat shipping
        $total = $subtotal + $tax + $shipping;

        return view('storefront.checkout.index', compact(
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'total'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_zip' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        try {
            $subtotal = $this->cartService->getTotal();

            $order = $this->orderService->createOrder([
                'user_id' => Auth::id(),
                'tax_rate' => 0.1, // 10%
                'shipping_cost' => 10,
                ...$validated,
            ]);

            // Here you would integrate with Stripe
            // For now, we'll mark it as pending payment

            return redirect()->route('checkout.success', $order->id)
                ->with('success', __('storefront.order_placed'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function success($orderId)
    {
        $order = Auth::user()->orders()->with('items.product')->findOrFail($orderId);

        return view('storefront.checkout.success', compact('order'));
    }
}
