# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 e-commerce application with a dual-interface architecture:
- **Storefront**: Public-facing shop for customers (routes start at `/`)
- **Admin Panel**: Traditional Laravel controllers and views (routes start at `/admin`)

The application supports English and Arabic with a sophisticated multi-layer translation system.

## Development Commands

### Setup
```bash
composer setup              # Full initial setup (install, migrate, npm build)
php artisan storage:link    # Create storage symlink (required for uploads)
```

### Development
```bash
composer dev               # Run server, queue, logs, and vite concurrently
php artisan serve          # Development server only
npm run dev                # Vite only
php artisan queue:listen   # Queue worker only
php artisan pail           # Real-time logs
```

### Testing
```bash
composer test              # Run PHPUnit tests
php artisan test           # Alternative test runner
php artisan test --filter TestName  # Run single test
```

### Database
```bash
php artisan migrate:fresh --seed  # Reset database with demo data
```

Demo users created by seeder:
- Admin: `admin@admin.com` / `password`
- Staff: `staff@example.com` / `password`
- Customer: `customer@example.com` / `password`

### Code Quality
```bash
./vendor/bin/pint          # Format code (Laravel Pint)
```

## Architecture

### Dual-Interface Pattern

The application has two distinct user interfaces that share models but have separate controllers and views:

**Storefront** (`app/Http/Controllers/Storefront/`):
- Controllers: `HomeController`, `ProductController`, `CartController`, `CheckoutController`
- Views: `resources/views/storefront/`
- Authentication: Laravel Breeze
- Accessible to all users (guest and authenticated)

**Admin Panel** (`app/Http/Controllers/Admin/`):
- Controllers: `CategoryController`, `ProductController`, `OrderController`, `UserController`, `SettingController`, `DashboardController`, `AuthController`
- Views: `resources/views/admin/`
- Access: `/admin` - restricted to users with 'admin' or 'staff' role
- Authentication: Custom admin authentication
- Permissions: Managed by Spatie Permission (AdminMiddleware checks for admin/staff roles)

### Service Layer Pattern

Business logic is NOT in controllers. Use service classes:

**CartService** (`app/Services/CartService.php`):
- Handles both guest (session-based) and authenticated user carts
- Database-backed (not session storage) using `cart_items` table
- Key method: `mergeGuestCart()` - called on user login to preserve guest cart
- Operations: `addItem()`, `updateQuantity()`, `removeItem()`, `getTotal()`, `getCount()`, `clear()`

**OrderService** (`app/Services/OrderService.php`):
- Transactional order creation with `DB::transaction()`
- Automatic inventory management (decrements stock on order, increments on cancellation)
- Stock validation before order creation
- Snapshot pattern: stores product details in `order_items` to preserve historical data

When adding e-commerce features, use these services rather than putting logic in controllers.

### Translation System

**Two-layer translation approach** - important to understand both:

1. **Model Translations** (Spatie Translatable with JSON columns):
   - For user-generated content: Product and Category models
   - Stored as JSON in database: `name->en`, `name->ar`
   - Models declare translatable fields:
     ```php
     use Spatie\Translatable\HasTranslations;

     public array $translatable = ['name', 'description'];
     ```
   - In admin forms, use separate fields with array notation:
     ```php
     <input name="name[en]" placeholder="Name (English)">
     <input name="name[ar]" placeholder="Name (Arabic)">
     ```

2. **View Translations** (Laravel lang files):
   - For static UI text in storefront
   - Location: `resources/lang/{locale}/storefront.php`
   - Usage in views: `__('storefront.add_to_cart')`
   - **Important**: This app uses custom `storefront.php` files, NOT Laravel's default `auth.php`, `validation.php`

**Locale Management**:
- Supported locales: `['en', 'ar']` (hardcoded in `SetLocale` middleware)
- Default locale: Arabic (`APP_LOCALE=ar` in `.env`)
- Fallback: English
- **SetLocale Middleware** (applied to all web routes):
  - Priority: session > cookie > config default
  - Validates locale against allowed list
- Language switching:
  - Storefront: `POST /language/switch` - sets session AND cookie (1 year)
  - Admin: `GET /admin/locale/{locale}` - sets session only

### Database Models & Relationships

**Key models** (all in `app/Models/`):

**Product**:
- Translatable fields: `name`, `description` (JSON columns)
- Fields: `slug`, `price`, `compare_at_price`, `cost`, `sku`, `barcode`, `quantity`, `featured_image`, `category_id`, `is_active`, `is_featured`
- Relationships: `belongsTo(Category)`, `hasMany(ProductImage)`, `hasMany(OrderItem)`, `hasMany(CartItem)`
- Scopes: `active()`, `featured()`, `inStock()`
- Accessors: `formatted_price`, `in_stock` (boolean)

**Category**:
- Translatable fields: `name`, `description` (JSON columns)
- Hierarchical: `parent_id` (self-referential)
- Relationships: `belongsTo(parent)`, `hasMany(children)`, `hasMany(products)`
- Scopes: `active()`, `parent()` (only top-level categories)

**Order**:
- Auto-generates `order_number` in boot method: `ORD-{UNIQID}`
- Status enum: `pending`, `processing`, `shipped`, `delivered`, `cancelled`
- Stores complete customer and shipping details (not just user_id)
- Relationships: `belongsTo(User)`, `hasMany(OrderItem)`

**OrderItem** (snapshot pattern):
- Stores `product_name`, `product_sku`, `price` at order time
- Prevents historical orders from changing when product details change
- Relationships: `belongsTo(Order)`, `belongsTo(Product)`

**CartItem** (hybrid guest/user support):
- Dual identification: `user_id` (authenticated) OR `session_id` (guest)
- Indexes on both `[user_id, product_id]` and `[session_id, product_id]`
- Accessor: `subtotal` (quantity * product.price)

**User**:
- Uses: `HasRoles` trait (Spatie Permission)
- Admin panel access: AdminMiddleware checks for 'admin' or 'staff' role
- Roles: admin, staff, customer (created by seeder)

**Setting** (key-value store):
- Static methods: `Setting::get($key, $default)`, `Setting::set($key, $value, $type, $group)`
- Type handling: boolean, json, string

### File Storage

- Default disk: `local` (storage/app/private)
- Public uploads: `public` disk (storage/app/public)
- **Important**: Run `php artisan storage:link` to create symlink `public/storage -> storage/app/public`
- Category images: stored in `categories/` directory
- Product images: stored via `featured_image` field and `product_images` table with `image_path`

### Admin Controllers

**Implementation Status**:
- ✅ **CategoryController**: Fully implemented with translatable fields, parent selector, image upload
- ✅ **ProductController**: Fully implemented with translatable fields, category selector, pricing, inventory
- ✅ **OrderController**: Fully implemented with status management, inventory restoration on cancellation
- ✅ **UserController**: Fully implemented with role management, password handling
- ✅ **SettingController**: Fully implemented with key-value storage, type handling
- ✅ **DashboardController**: Basic implementation
- ✅ **AuthController**: Custom admin authentication (login, logout, locale switching)

All controllers follow the same pattern:
- Translatable fields use array notation: `name.en`, `name.ar`
- Image uploads stored in public disk
- Success/error messages use admin translation keys
- Validation rules include unique checks with current model ID exclusion

### Routes Organization

**Storefront Routes** (`routes/web.php`):
```php
// Language switching
POST /language/switch

// Public pages
GET /                              # Home
GET /products                      # Product listing
GET /product/{slug}                # Product detail
GET /category/{slug}               # Category products

// Cart (guest-accessible)
GET /cart
POST /cart/add
PATCH /cart/{cartItem}
DELETE /cart/{cartItem}

// Authenticated only
GET /checkout
POST /checkout
GET /checkout/success/{order}
```

**Admin Routes** (`routes/web.php`):
```php
// Authentication (guest only)
GET  /admin/login
POST /admin/login

// Authenticated routes (admin/staff only via AdminMiddleware)
POST /admin/logout
GET  /admin/locale/{locale}
GET  /admin                          # Dashboard

// Resource routes
/admin/categories                    # Full CRUD
/admin/products                      # Full CRUD
/admin/orders                        # index, show, edit, update, destroy (no create/store)
PATCH /admin/orders/{order}/status   # Quick status update
/admin/users                         # Full CRUD
/admin/settings                      # Full CRUD
```

### Frontend Stack

- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Alpine.js 3.x
- **Build Tool**: Vite
- **Components**: Custom Blade components in `resources/views/components/storefront/`
  - `header.blade.php` - Top bar with email, language switcher, navigation
  - `footer.blade.php` - Footer with links and newsletter
  - `product-card.blade.php` - Reusable product card
  - `search-bar.blade.php` - Search input
  - `button.blade.php` - Styled button component
  - `breadcrumbs.blade.php` - Navigation breadcrumbs
  - `alert.blade.php` - Success/error messages
  - `pagination.blade.php` - Custom pagination

### Authentication & Authorization

**Two Auth Systems**:
1. **Storefront**: Laravel Breeze (views in `resources/views/auth/`)
2. **Admin Panel**: Custom authentication (AuthController + AdminMiddleware)

**Permissions** (Spatie Permission):
- Roles: admin, staff, customer
- Panel access: Checked via `AdminMiddleware` - requires 'admin' or 'staff' role
- AdminMiddleware redirects unauthorized users to admin login page
- User role management handled through UserController

## Important Patterns & Conventions

### When Adding Translations

For **static UI text** in storefront views:
1. Add key to `resources/lang/en/storefront.php`
2. Add Arabic translation to `resources/lang/ar/storefront.php`
3. Use in view: `{{ __('storefront.your_key') }}`

For **model content** (products, categories):
1. Ensure model uses `HasTranslations` trait
2. Declare field in `$translatable` array
3. In admin forms, use array notation: `<input name="name[en]">`, `<input name="name[ar]">`
4. In controllers, set translatable fields as arrays: `$model->name = ['en' => $value_en, 'ar' => $value_ar]`
5. Migrations use `json()` type for translatable columns

### Cart Flow

1. Guest adds items → stored in `cart_items` with `session_id`
2. Guest logs in → `CartService::mergeGuestCart()` called by `AuthenticatedSessionController`
3. Items merged to user's cart (updates `session_id` to `user_id`)
4. Guest cart cleared

### Order Flow

1. Checkout form submitted → `CheckoutController@store`
2. `OrderService::createOrder($user, $cartItems, $data)` called
3. Inside transaction:
   - Create Order record
   - Create OrderItem records (snapshot product details)
   - Decrement product quantities
   - Clear cart
4. Redirect to success page

### Inventory Management

- Stock checked in `OrderService::createOrder()` before order creation
- Stock decremented atomically in same transaction as order
- Stock restored automatically when order status changes to 'cancelled' (handled in OrderController)
- Stock decremented when cancelled order is reactivated (with validation)
- `Product::inStock()` scope filters products with `quantity > 0`

## Common Pitfalls

1. **Don't put business logic in controllers** - use CartService/OrderService
2. **Don't forget `php artisan storage:link`** - images won't display without it
3. **Translation files are NOT standard Laravel** - use `storefront.php` and `admin.php`, not `auth.php`
4. **Guest carts are database-backed** - don't assume they're in session
5. **Translatable fields use array notation** - `name.en` in forms, `['en' => ..., 'ar' => ...]` in controllers
6. **SetLocale middleware is critical** - don't bypass it or translations break
7. **Order items store snapshots** - don't expect live product data in historical orders
8. **Both admin and staff can access panel** - AdminMiddleware checks for both roles

## Testing Considerations

- Seed database for consistent test data: `php artisan migrate:fresh --seed`
- Test both guest and authenticated cart flows
- Test locale switching (session persistence, cookie persistence)
- Test stock depletion scenarios (prevent overselling)
- Test cart merging on login
- Test admin authentication and role-based access control
- Test order cancellation and inventory restoration
- Verify translatable fields work correctly in both languages

## Known Issues / TODOs

- Admin views need to be created (currently only controllers exist)
- Storage symlink not created by default (manual `php artisan storage:link` required)
- No automated tests present
- Product images table exists but not integrated into admin forms yet
- Always translate the text and content in storefront and admin panel