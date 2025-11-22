<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::with('parent')
            ->withCount('products')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        // Prepare translatable fields
        $category = new Category;
        $category->name = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar'],
        ];
        $category->description = [
            'en' => $validated['description']['en'] ?? null,
            'ar' => $validated['description']['ar'] ?? null,
        ];
        $category->slug = $validated['slug'];
        $category->parent_id = $validated['parent_id'] ?? null;
        $category->image = $validated['image'] ?? null;
        $category->is_active = $request->boolean('is_active', true);
        $category->sort_order = $validated['sort_order'] ?? 0;
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', __('admin.created_successfully', ['resource' => __('admin.category')]));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        // Update translatable fields
        $category->name = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar'],
        ];
        $category->description = [
            'en' => $validated['description']['en'] ?? null,
            'ar' => $validated['description']['ar'] ?? null,
        ];
        $category->slug = $validated['slug'];
        $category->parent_id = $validated['parent_id'] ?? null;
        if (isset($validated['image'])) {
            $category->image = $validated['image'];
        }
        $category->is_active = $request->boolean('is_active');
        $category->sort_order = $validated['sort_order'] ?? 0;
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.category')]));
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', __('admin.cannot_delete', ['resource' => __('admin.category')]));
        }

        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.category')]));
    }
}
