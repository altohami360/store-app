<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->limit(8)
            ->get();

        $categories = Category::active()
            ->parent()
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        return view('storefront.home', compact('featuredProducts', 'categories'));
    }
}
