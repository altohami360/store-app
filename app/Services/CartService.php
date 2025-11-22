<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected function getIdentifier(): array
    {
        if (Auth::check()) {
            return ['user_id' => Auth::id()];
        }

        $sessionId = Session::getId();
        if (empty($sessionId)) {
            Session::start();
            $sessionId = Session::getId();
        }

        return ['session_id' => $sessionId];
    }

    public function addItem(int $productId, int $quantity = 1): CartItem
    {
        $product = Product::findOrFail($productId);

        $identifier = $this->getIdentifier();

        $cartItem = CartItem::where($identifier)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                ...$identifier,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return $cartItem;
    }

    public function updateQuantity(int $cartItemId, int $quantity): CartItem
    {
        $identifier = $this->getIdentifier();

        $cartItem = CartItem::where($identifier)
            ->where('id', $cartItemId)
            ->firstOrFail();

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return $cartItem;
    }

    public function removeItem(int $cartItemId): bool
    {
        $identifier = $this->getIdentifier();

        return CartItem::where($identifier)
            ->where('id', $cartItemId)
            ->delete();
    }

    public function getItems()
    {
        $identifier = $this->getIdentifier();

        return CartItem::where($identifier)
            ->with('product')
            ->get();
    }

    public function getTotal(): float
    {
        $items = $this->getItems();

        return $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function getCount(): int
    {
        $identifier = $this->getIdentifier();

        return CartItem::where($identifier)->sum('quantity');
    }

    public function clear(): void
    {
        $identifier = $this->getIdentifier();

        CartItem::where($identifier)->delete();
    }

    public function mergeGuestCart(string $guestSessionId): void
    {
        if (! Auth::check()) {
            return;
        }

        $guestItems = CartItem::where('session_id', $guestSessionId)->get();

        foreach ($guestItems as $guestItem) {
            $existingItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existingItem) {
                $existingItem->quantity += $guestItem->quantity;
                $existingItem->save();
            } else {
                $guestItem->user_id = Auth::id();
                $guestItem->session_id = null;
                $guestItem->save();
            }
        }

        CartItem::where('session_id', $guestSessionId)->delete();
    }
}
