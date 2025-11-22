<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'barcode' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
        }

        // Prepare translatable fields
        $product = new Product();
        $product->name = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar'],
        ];
        $product->description = [
            'en' => $validated['description']['en'] ?? null,
            'ar' => $validated['description']['ar'] ?? null,
        ];
        $product->slug = $validated['slug'];
        $product->category_id = $validated['category_id'];
        $product->price = $validated['price'];
        $product->compare_at_price = $validated['compare_at_price'] ?? null;
        $product->cost = $validated['cost'] ?? null;
        $product->sku = $validated['sku'] ?? null;
        $product->barcode = $validated['barcode'] ?? null;
        $product->quantity = $validated['quantity'];
        $product->featured_image = $validated['featured_image'] ?? null;
        $product->is_active = $request->boolean('is_active', true);
        $product->is_featured = $request->boolean('is_featured', false);
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', __('admin.created_successfully', ['resource' => __('admin.product')]));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'barcode' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
        }

        // Update translatable fields
        $product->name = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar'],
        ];
        $product->description = [
            'en' => $validated['description']['en'] ?? null,
            'ar' => $validated['description']['ar'] ?? null,
        ];
        $product->slug = $validated['slug'];
        $product->category_id = $validated['category_id'];
        $product->price = $validated['price'];
        $product->compare_at_price = $validated['compare_at_price'] ?? null;
        $product->cost = $validated['cost'] ?? null;
        $product->sku = $validated['sku'] ?? null;
        $product->barcode = $validated['barcode'] ?? null;
        $product->quantity = $validated['quantity'];
        if (isset($validated['featured_image'])) {
            $product->featured_image = $validated['featured_image'];
        }
        $product->is_active = $request->boolean('is_active');
        $product->is_featured = $request->boolean('is_featured');
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.product')]));
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Check if product has orders
        if ($product->orderItems()->count() > 0) {
            return redirect()->route('admin.products.index')
                ->with('error', __('admin.cannot_delete', ['resource' => __('admin.product')]));
        }

        // Delete image if exists
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.product')]));
    }
}
