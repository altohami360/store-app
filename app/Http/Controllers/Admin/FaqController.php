<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the FAQs.
     */
    public function index()
    {
        $faqs = Faq::ordered()->paginate(15);

        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question.en' => 'required|string|max:500',
            'question.ar' => 'required|string|max:500',
            'answer.en' => 'required|string',
            'answer.ar' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $faq = new Faq;
        $faq->question = [
            'en' => $validated['question']['en'],
            'ar' => $validated['question']['ar'],
        ];
        $faq->answer = [
            'en' => $validated['answer']['en'],
            'ar' => $validated['answer']['ar'],
        ];
        $faq->is_active = $request->boolean('is_active', true);
        $faq->order = $validated['order'] ?? 0;
        $faq->save();

        return redirect()->route('admin.faqs.index')
            ->with('success', __('admin.created_successfully', ['resource' => __('admin.faq')]));
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question.en' => 'required|string|max:500',
            'question.ar' => 'required|string|max:500',
            'answer.en' => 'required|string',
            'answer.ar' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $faq->question = [
            'en' => $validated['question']['en'],
            'ar' => $validated['question']['ar'],
        ];
        $faq->answer = [
            'en' => $validated['answer']['en'],
            'ar' => $validated['answer']['ar'],
        ];
        $faq->is_active = $request->boolean('is_active');
        $faq->order = $validated['order'] ?? 0;
        $faq->save();

        return redirect()->route('admin.faqs.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.faq')]));
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.faq')]));
    }
}
