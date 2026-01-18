<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::where('is_admin', false)->inRandomOrder()->first()
            ?? User::factory()->create(['is_admin' => false]);

        $subtotal = fake()->randomFloat(2, 50, 500);
        $tax = $subtotal * 0.15; // 15% tax
        $shipping = fake()->randomFloat(2, 5, 25);
        $total = $subtotal + $tax + $shipping;

        $createdAt = fake()->dateTimeBetween(startDate: '-1 year', endDate:  'now');

        return [
            'user_id' => $user->id,
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone ?? fake()->phoneNumber(),
            'shipping_address' => fake()->streetAddress(),
            'shipping_city' => fake()->randomElement(['Riyadh', 'Jeddah', 'Dammam', 'Mecca', 'Medina', 'Khobar', 'Tabuk']),
            'shipping_state' => fake()->randomElement(['Riyadh Region', 'Makkah Region', 'Eastern Region', 'Asir Region', 'Madinah Region']),
            'shipping_zip' => fake()->postcode(),
            'shipping_country' => 'Saudi Arabia',
            'payment_method' => fake()->randomElement(['credit_card', 'debit_card', 'paypal', 'cash_on_delivery']),
            'payment_status' => fake()->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'transaction_id' => fake()->optional()->uuid(),
            'notes' => fake()->optional()->sentence(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    /**
     * Indicate that the order is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);
    }

    /**
     * Indicate that the order is processing.
     */
    public function processing(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'processing',
            'payment_status' => 'paid',
        ]);
    }

    /**
     * Indicate that the order is shipped.
     */
    public function shipped(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'shipped',
            'payment_status' => 'paid',
        ]);
    }

    /**
     * Indicate that the order is delivered.
     */
    public function delivered(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'delivered',
            'payment_status' => 'paid',
        ]);
    }

    /**
     * Indicate that the order is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
            'payment_status' => 'refunded',
        ]);
    }
}
