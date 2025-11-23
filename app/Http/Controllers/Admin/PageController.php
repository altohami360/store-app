<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the pages.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created page in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'meta_description.en' => 'nullable|string|max:500',
            'meta_description.ar' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $page = new Page;
        $page->title = [
            'en' => $validated['title']['en'],
            'ar' => $validated['title']['ar'],
        ];
        $page->slug = $validated['slug'];
        $page->content = [
            'en' => $validated['content']['en'],
            'ar' => $validated['content']['ar'],
        ];
        $page->meta_description = [
            'en' => $validated['meta_description']['en'] ?? null,
            'ar' => $validated['meta_description']['ar'] ?? null,
        ];
        $page->is_active = $request->boolean('is_active', true);
        $page->save();

        return redirect()->route('admin.pages.index')
            ->with('success', __('admin.created_successfully', ['resource' => __('admin.page')]));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,'.$page->id,
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'meta_description.en' => 'nullable|string|max:500',
            'meta_description.ar' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $page->title = [
            'en' => $validated['title']['en'],
            'ar' => $validated['title']['ar'],
        ];
        $page->slug = $validated['slug'];
        $page->content = [
            'en' => $validated['content']['en'],
            'ar' => $validated['content']['ar'],
        ];
        $page->meta_description = [
            'en' => $validated['meta_description']['en'] ?? null,
            'ar' => $validated['meta_description']['ar'] ?? null,
        ];
        $page->is_active = $request->boolean('is_active');
        $page->save();

        return redirect()->route('admin.pages.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.page')]));
    }

    /**
     * Remove the specified page from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.page')]));
    }
}
