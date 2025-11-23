<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $customerRole = Role::create(['name' => 'customer']);

        // Create Admin User
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
        $admin->assignRole('admin');

        // Create Staff User
        $staff = User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'phone' => '123456781',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
        $staff->assignRole('staff');

        // Create Customer User
        $customer = User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'phone' => '123456782',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
        $customer->assignRole('customer');

        // Create Categories
        $electronics = Category::create([
            'name' => [
                'en' => 'Electronics',
                'ar' => 'الإلكترونيات',
            ],
            'slug' => 'electronics',
            'description' => [
                'en' => 'Electronic devices and gadgets',
                'ar' => 'الأجهزة الإلكترونية والأدوات',
            ],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $clothing = Category::create([
            'name' => [
                'en' => 'Clothing',
                'ar' => 'الملابس',
            ],
            'slug' => 'clothing',
            'description' => [
                'en' => 'Fashion and apparel',
                'ar' => 'الأزياء والملابس',
            ],
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $home = Category::create([
            'name' => [
                'en' => 'Home & Garden',
                'ar' => 'المنزل والحديقة',
            ],
            'slug' => 'home-garden',
            'description' => [
                'en' => 'Home improvement and garden supplies',
                'ar' => 'مستلزمات تحسين المنزل والحديقة',
            ],
            'is_active' => true,
            'sort_order' => 3,
        ]);

        // Create Products for Electronics
        Product::create([
            'name' => [
                'en' => 'Wireless Headphones',
                'ar' => 'سماعات لاسلكية',
            ],
            'slug' => 'wireless-headphones',
            'description' => [
                'en' => 'Premium wireless headphones with noise cancellation',
                'ar' => 'سماعات لاسلكية فاخرة مع إلغاء الضوضاء',
            ],
            'price' => 99.99,
            'compare_at_price' => 129.99,
            'cost' => 50.00,
            'sku' => 'WH-001',
            'quantity' => 50,
            'category_id' => $electronics->id,
            'is_active' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'name' => [
                'en' => 'Smart Watch',
                'ar' => 'ساعة ذكية',
            ],
            'slug' => 'smart-watch',
            'description' => [
                'en' => 'Feature-rich smartwatch with health tracking',
                'ar' => 'ساعة ذكية غنية بالميزات مع تتبع الصحة',
            ],
            'price' => 199.99,
            'compare_at_price' => 249.99,
            'cost' => 100.00,
            'sku' => 'SW-001',
            'quantity' => 30,
            'category_id' => $electronics->id,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Create Products for Clothing
        Product::create([
            'name' => [
                'en' => 'Cotton T-Shirt',
                'ar' => 'قميص قطني',
            ],
            'slug' => 'cotton-t-shirt',
            'description' => [
                'en' => 'Comfortable 100% cotton t-shirt',
                'ar' => 'قميص قطني مريح 100%',
            ],
            'price' => 19.99,
            'compare_at_price' => 29.99,
            'cost' => 8.00,
            'sku' => 'TS-001',
            'quantity' => 100,
            'category_id' => $clothing->id,
            'is_active' => true,
            'is_featured' => false,
        ]);

        Product::create([
            'name' => [
                'en' => 'Denim Jeans',
                'ar' => 'بنطال جينز',
            ],
            'slug' => 'denim-jeans',
            'description' => [
                'en' => 'Classic blue denim jeans',
                'ar' => 'بنطال جينز أزرق كلاسيكي',
            ],
            'price' => 49.99,
            'compare_at_price' => 69.99,
            'cost' => 20.00,
            'sku' => 'DJ-001',
            'quantity' => 75,
            'category_id' => $clothing->id,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Create Products for Home & Garden
        Product::create([
            'name' => [
                'en' => 'LED Desk Lamp',
                'ar' => 'مصباح مكتب LED',
            ],
            'slug' => 'led-desk-lamp',
            'description' => [
                'en' => 'Adjustable LED desk lamp with USB charging',
                'ar' => 'مصباح مكتب LED قابل للتعديل مع شحن USB',
            ],
            'price' => 39.99,
            'compare_at_price' => 54.99,
            'cost' => 15.00,
            'sku' => 'DL-001',
            'quantity' => 40,
            'category_id' => $home->id,
            'is_active' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'name' => [
                'en' => 'Garden Tool Set',
                'ar' => 'مجموعة أدوات الحديقة',
            ],
            'slug' => 'garden-tool-set',
            'description' => [
                'en' => 'Complete garden tool set with carrying case',
                'ar' => 'مجموعة أدوات حديقة كاملة مع حقيبة حمل',
            ],
            'price' => 79.99,
            'compare_at_price' => 99.99,
            'cost' => 35.00,
            'sku' => 'GT-001',
            'quantity' => 25,
            'category_id' => $home->id,
            'is_active' => true,
            'is_featured' => false,
        ]);

        // Seed FAQs
        $this->call(FaqSeeder::class);

        // Seed Pages
        $this->call(PageSeeder::class);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin credentials: admin@example.com / password');
        $this->command->info('Staff credentials: staff@example.com / password');
        $this->command->info('Customer credentials: customer@example.com / password');
    }
}
