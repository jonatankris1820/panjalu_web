<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->orderBy('sort_order')->get();
        return view('public.pages.product', compact('products'));
    }

    public function show(string $slug)
    {
        $product = Product::active()
            ->with(['images', 'features', 'priceTiers', 'priceNotes', 'sizeHeader', 'sizeRows', 'colors'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.pages.product-detail', compact('product'));
    }
}
