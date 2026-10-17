<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\WaClickTracking;
use Illuminate\Http\Request;

class WaTrackingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'source'       => ['required', 'in:float,contact,product'],
            'product_slug' => ['nullable', 'string', 'max:255'],
        ]);

        WaClickTracking::create([
            'source'       => $validated['source'],
            'product_slug' => $validated['product_slug'] ?? null,
            'clicked_date' => now()->toDateString(),
        ]);

        return response()->json(['success' => true]);
    }
}
