# Bilingual E-Commerce Platform Documentation

## Overview

This is a complete bilingual (English/Arabic) e-commerce platform built with:
- **Backend**: Laravel 12
- **Admin Panel**: FilamentPHP 3.x
- **Frontend**: Blade Templates + TailwindCSS
- **Database**: MySQL
- **Translations**: Spatie Laravel Translatable
- **Permissions**: Spatie Laravel Permission + Filament Shield

---

## System Features

### 1. Authentication & User Management
- User registration and login
- Role-based permissions (Admin, Staff, Customer)
- User management through Filament admin panel

### 2. Product Management
- CRUD operations for products
- Bilingual product names and descriptions (English/Arabic)
- Product categories and subcategories
- Inventory management
- Product image galleries
- Featured products
- Stock tracking

### 3. Category Management
- Parent/child category relationships
- Bilingual category names and descriptions
- Category images
- Active/inactive status
- Sort ordering

### 4. Storefront Features
- Responsive homepage with featured products
- Product listing with filtering and sorting
- Product detail pages
- Category pages
- Language switcher (EN/AR)
- Fully responsive TailwindCSS UI
- RTL support for Arabic

### 5. Shopping Cart
- Add to cart functionality
- Update cart quantities
- Remove items from cart
- Persistent cart (database-backed)
- Guest cart merging upon login
- Cart item count display

### 6. Checkout & Orders
- Secure checkout process
- Customer information collection
- Shipping address management
- Order placement
- Order history for customers
- Stripe payment integration (placeholder ready)

### 7. Admin Panel (FilamentPHP)
- Product management with bilingual support
- Category management with parent/child support
- Order management and status updates
- User management with roles
- Settings management
- File uploads for product images
- Rich dashboard interface

### 8. Settings System
- Flexible key-value settings storage
- Support for multiple data types (string, boolean, JSON, image)
- Grouped settings (general, store, payment, shipping)
- Easy retrieval and update methods

---

## Project Structure

```
filament-store/
├── app/
│   ├── Filament/
│   │   └── Resources/
│   │       ├── CategoryResource.php
│   │       ├── ProductResource.php
│   │       ├── OrderResource.php
│   │       ├── UserResource.php
│   │       └── SettingResource.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Storefront/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CartController.php
│   │   │   │   └── CheckoutController.php
│   │   │   └── LanguageController.php
│   │   └── Middleware/
│   │       └── SetLocale.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── ProductImage.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── CartItem.php
│   │   ├── Setting.php
│   │   └── User.php
│   └── Services/
│       ├── CartService.php
│       └── OrderService.php
├── database/
│   ├── migrations/
│   │   ├── 2025_11_21_145942_create_permission_tables.php
│   │   ├── 2025_11_21_150011_create_categories_table.php
│   │   ├── 2025_11_21_150018_create_products_table.php
│   │   ├── 2025_11_21_150018_create_product_images_table.php
│   │   ├── 2025_11_21_150018_create_orders_table.php
│   │   ├── 2025_11_21_150018_create_order_items_table.php
│   │   ├── 2025_11_21_150018_create_cart_items_table.php
│   │   └── 2025_11_21_150018_create_settings_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── lang/
│   │   ├── en/
│   │   │   └── storefront.php
│   │   └── ar/
│   │       └── storefront.php
│   └── views/
│       └── storefront/
│           ├── layouts/
│           │   └── app.blade.php
│           └── home.blade.php
└── routes/
    └── web.php
```

---

## Installation & Setup

### 1. Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL 8.0 or higher

### 2. Clone and Install Dependencies

```bash
# Navigate to project directory
cd filament-store

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy .env.example to .env (already exists in your case)
cp .env.example .env

# Generate application key (if not already done)
php artisan key:generate
```

Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filament_store
DB_USERNAME=your_username
DB_PASSWORD=your_password

APP_URL=http://localhost:8000
```

### 4. Database Setup

```bash
# Create database (using MySQL CLI or GUI)
mysql -u root -p
CREATE DATABASE filament_store;
exit;

# Run migrations
php artisan migrate

# Run seeders (creates sample data + test users)
php artisan db:seed
```

### 5. Storage Link

```bash
# Create symbolic link for file uploads
php artisan storage:link
```

### 6. Compile Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Install Filament Shield (for permissions)

```bash
# Install Shield resources
php artisan shield:install

# Generate permissions for all resources
php artisan shield:generate --all
```

### 8. Start Development Server

```bash
php artisan serve
```

Your application will be available at `http://localhost:8000`

---

## Default Credentials

After running `php artisan db:seed`, you can login with:

**Admin User:**
- Email: `admin@example.com`
- Password: `password`
- Access: Full admin panel access

**Staff User:**
- Email: `staff@example.com`
- Password: `password`
- Access: Limited admin panel access

**Customer User:**
- Email: `customer@example.com`
- Password: `password`
- Access: Storefront only

---

## Access Points

### Storefront
- Homepage: `http://localhost:8000/`
- Products: `http://localhost:8000/products`
- Cart: `http://localhost:8000/cart`
- Checkout: `http://localhost:8000/checkout` (requires login)

### Admin Panel
- Admin Panel: `http://localhost:8000/admin`
- Login with admin or staff credentials

---

## Usage Guide

### For Administrators

#### Managing Categories
1. Login to admin panel
2. Navigate to **Shop → Categories**
3. Click **New Category**
4. Fill in English and Arabic names
5. Set parent category (optional)
6. Upload category image
7. Set sort order and active status
8. Save

#### Managing Products
1. Navigate to **Shop → Products**
2. Click **New Product**
3. Fill in bilingual product information:
   - Name (EN/AR)
   - Description (EN/AR)
   - Price, SKU, quantity
4. Select category
5. Upload featured image
6. Set as featured/active
7. Save

#### Managing Orders
1. Navigate to **Shop → Orders**
2. View all orders
3. Click on an order to see details
4. Update order status:
   - Pending → Processing → Shipped → Delivered
   - Or cancel if needed
5. View customer information and order items

#### Managing Users
1. Navigate to **Users**
2. Create new users or edit existing ones
3. Assign roles (admin/staff/customer)
4. Manage user permissions

### For Customers

#### Browsing Products
1. Visit homepage
2. Browse featured products
3. Click on categories or use search
4. View product details
5. Select quantity and add to cart

#### Checkout Process
1. Add products to cart
2. Review cart at `/cart`
3. Click **Proceed to Checkout**
4. Login or register
5. Fill in shipping information
6. Review order summary
7. Place order
8. View order confirmation

#### Language Switching
- Click language toggle in header
- Interface switches between English and Arabic
- Product names/descriptions display in selected language
- RTL layout for Arabic

---

## Bilingual Implementation

### Database Level
Products, categories, and other translatable content use JSON columns:
```json
{
  "en": "Product Name",
  "ar": "اسم المنتج"
}
```

### Model Level
Models use Spatie Translatable trait:
```php
use HasTranslations;

public array $translatable = ['name', 'description'];
```

### View Level
Access translations automatically:
```blade
{{ $product->name }} // Returns name in current locale
{{ $product->getTranslation('name', 'ar') }} // Force Arabic
```

### Localization Files
UI strings are translated in `resources/lang/{locale}/storefront.php`

---

## Service Classes

### CartService
Handles all cart operations:
- `addItem($productId, $quantity)` - Add product to cart
- `updateQuantity($cartItemId, $quantity)` - Update item quantity
- `removeItem($cartItemId)` - Remove item from cart
- `getItems()` - Get all cart items
- `getTotal()` - Calculate cart total
- `getCount()` - Get total item count
- `clear()` - Empty cart
- `mergeGuestCart($guestSessionId)` - Merge guest cart after login

### OrderService
Handles order operations:
- `createOrder($data)` - Create new order
- `updateOrderStatus($order, $status)` - Update order status
- `processPayment($order, $transactionId)` - Mark order as paid

---

## Payment Integration

The system includes a placeholder for Stripe payment integration:

### Setup Stripe
1. Install Stripe SDK:
```bash
composer require stripe/stripe-php
```

2. Add Stripe keys to `.env`:
```env
STRIPE_KEY=your_publishable_key
STRIPE_SECRET=your_secret_key
```

3. Implement payment in `CheckoutController@store`:
```php
\Stripe\Stripe::setApiKey(config('services.stripe.secret'));

$charge = \Stripe\Charge::create([
    'amount' => $total * 100, // Amount in cents
    'currency' => 'usd',
    'source' => $request->stripeToken,
    'description' => 'Order #' . $order->order_number,
]);

$this->orderService->processPayment($order, $charge->id);
```

---

## Customization

### Adding More Languages
1. Create language file: `resources/lang/{locale}/storefront.php`
2. Update `SetLocale` middleware to include new locale
3. Update language switcher in layout

### Customizing Email Templates
```bash
php artisan vendor:publish --tag=laravel-mail
```
Edit templates in `resources/views/vendor/mail`

### Adding Product Attributes
1. Create migration for attributes table
2. Create Attribute model
3. Add relationship to Product model
4. Update ProductResource in Filament

### Customizing Admin Panel
Edit Filament resources in `app/Filament/Resources/`
See [Filament Documentation](https://filamentphp.com/docs)

---

## Testing

### Run Migrations in Testing Environment
```bash
php artisan migrate --env=testing
```

### Create Test Data
```bash
php artisan db:seed
```

---

## Production Deployment

### 1. Optimize Application
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### 2. Set Permissions
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 3. Configure Web Server
Example Nginx configuration:
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/filament-store/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4. SSL Certificate
```bash
# Using Certbot
sudo certbot --nginx -d yourdomain.com
```

### 5. Environment Variables
- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Use strong `APP_KEY`
- Update database credentials
- Configure mail settings

---

## Troubleshooting

### Issue: Permission Denied on Storage
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Issue: Translations Not Working
```bash
php artisan cache:clear
php artisan config:clear
```

### Issue: Images Not Displaying
```bash
php artisan storage:link
```

### Issue: 500 Error
- Check `storage/logs/laravel.log`
- Ensure `.env` is configured
- Run `php artisan config:clear`

---

## Additional Resources

- **Laravel Documentation**: https://laravel.com/docs
- **Filament Documentation**: https://filamentphp.com/docs
- **Spatie Translatable**: https://github.com/spatie/laravel-translatable
- **TailwindCSS**: https://tailwindcss.com/docs

---

## License

This project is open-sourced software licensed under the MIT license.

---

## Support & Contact

For issues and questions:
- Open an issue on GitHub
- Check documentation
- Review Laravel and Filament docs

---

**Built with ❤️ using Laravel, FilamentPHP, and TailwindCSS**
