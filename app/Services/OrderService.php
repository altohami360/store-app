<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $cartItems = $this->cartService->getItems();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            // Calculate totals
            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $tax = $subtotal * ($data['tax_rate'] ?? 0);
            $shipping = $data['shipping_cost'] ?? 0;
            $total = $subtotal + $tax + $shipping;

            // Create order
            $order = Order::create([
                'user_id' => $data['user_id'],
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'shipping_address' => $data['shipping_address'],
                'shipping_city' => $data['shipping_city'],
                'shipping_state' => $data['shipping_state'] ?? null,
                'shipping_zip' => $data['shipping_zip'],
                'shipping_country' => $data['shipping_country'],
                'payment_method' => $data['payment_method'] ?? 'stripe',
                'payment_status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            // Create order items and update inventory
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;

                // Check stock
                if ($product->quantity < $cartItem->quantity) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price,
                    'total' => $product->price * $cartItem->quantity,
                ]);

                // Update product quantity
                $product->decrement('quantity', $cartItem->quantity);
            }

            // Clear cart
            $this->cartService->clear();

            return $order;
        });
    }

    public function updateOrderStatus(Order $order, string $status): Order
    {
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (! in_array($status, $validStatuses)) {
            throw new \Exception('Invalid order status');
        }

        // If order is being cancelled, restore inventory
        if ($status === 'cancelled' && $order->status !== 'cancelled') {
            foreach ($order->items as $item) {
                $item->product->increment('quantity', $item->quantity);
            }
        }

        $order->status = $status;
        $order->save();

        return $order;
    }

    public function processPayment(Order $order, string $transactionId): Order
    {
        $order->payment_status = 'paid';
        $order->transaction_id = $transactionId;
        $order->status = 'processing';
        $order->save();

        return $order;
    }
}
