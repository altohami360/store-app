<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 100 customer users
        User::factory()
            ->count(100)
            ->create([
                'is_admin' => false,
            ]);

        $this->command->info('100 customers created successfully!');
    }
}
