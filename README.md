# Bilingual E-Commerce Platform

Complete bilingual (English/Arabic) e-commerce platform built with Laravel 12, FilamentPHP 3.x, and TailwindCSS.

## 🚀 Quick Start

### 1. Database Setup

First, update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filament_store
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the database:
```bash
mysql -u root -p
CREATE DATABASE filament_store;
exit;
```

### 2. Run Migrations

```bash
php artisan migrate
```

### 3. Seed Database (Optional but Recommended)

This creates test users, categories, and products:

```bash
php artisan db:seed
```

**Default Login Credentials:**
- Admin: `admin@example.com` / `password`
- Staff: `staff@example.com` / `password`
- Customer: `customer@example.com` / `password`

### 4. Create Storage Link

```bash
php artisan storage:link
```

### 5. Install Filament Shield

```bash
php artisan shield:install
php artisan shield:generate --all
```

### 6. Start Development Server

```bash
php artisan serve
```

Visit:
- **Storefront**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin

## 📚 Full Documentation

See `SETUP.md` for:
- Complete installation guide
- Feature documentation
- Customization guide
- Production deployment
- Troubleshooting

## ✨ Features

- ✅ Bilingual (English/Arabic) support
- ✅ Product & Category management
- ✅ Shopping cart & checkout
- ✅ Order management
- ✅ Role-based permissions
- ✅ FilamentPHP admin panel
- ✅ Responsive TailwindCSS design
- ✅ RTL support for Arabic

## 🔧 Tech Stack

- Laravel 12
- FilamentPHP 3.x
- TailwindCSS 3.x
- Laravel Breeze (Authentication)
- Spatie Translatable
- MySQL 8.0+

## 📝 License

MIT License
# store-app
