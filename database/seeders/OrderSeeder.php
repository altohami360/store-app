<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get customer users (non-admin)
        $customers = User::where('is_admin', false)->get();

        if ($customers->isEmpty()) {
            $this->command->warn('No customer users found. Please seed customers first.');
            return;
        }

        // Get all products
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('No products found. Please seed products first.');
            return;
        }

        $this->command->info('Creating 1000 orders...');
        $ordersCreated = 0;
        $targetOrders = 1000;

        // Create 1000 orders
        while ($ordersCreated < $targetOrders) {
            // Pick a random customer
            $customer = $customers->random();

            // Create order with random status
            $status = collect(['pending', 'processing', 'shipped', 'delivered', 'cancelled'])
                ->random();

            $order = Order::factory()->$status()->create([
                'user_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_phone' => $customer->phone ?? fake()->phoneNumber(),
            ]);

            // Add 1-5 items to each order
            $itemCount = rand(1, 5);
            $orderSubtotal = 0;

            for ($j = 0; $j < $itemCount; $j++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $price = $product->price;
                $total = $price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total,
                ]);

                $orderSubtotal += $total;
            }

            // Update order totals
            $tax = $orderSubtotal * 0.15;
            $shipping = fake()->randomFloat(2, 5, 25);
            $orderTotal = $orderSubtotal + $tax + $shipping;

            $order->update([
                'subtotal' => $orderSubtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $orderTotal,
            ]);

            $ordersCreated++;

            // Show progress every 100 orders
            if ($ordersCreated % 100 === 0) {
                $this->command->info("Created {$ordersCreated}/{$targetOrders} orders...");
            }
        }

        $this->command->info('1000 orders seeded successfully!');
    }
}
