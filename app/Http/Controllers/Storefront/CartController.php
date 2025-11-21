<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getItems();
        $total = $this->cartService->getTotal();

        return view('storefront.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartService->addItem(
            $request->product_id,
            $request->quantity
        );

        return redirect()->back()->with('success', __('storefront.product_added_to_cart'));
    }

    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartService->updateQuantity($cartItemId, $request->quantity);

        return redirect()->back()->with('success', __('storefront.cart_updated'));
    }

    public function remove($cartItemId)
    {
        $this->cartService->removeItem($cartItemId);

        return redirect()->back()->with('success', __('storefront.product_removed_from_cart'));
    }
}
