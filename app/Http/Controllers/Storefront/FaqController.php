<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQs page.
     */
    public function index()
    {
        $faqs = Faq::active()->ordered()->get();

        return view('storefront.faqs', compact('faqs'));
    }
}
