<?php

namespace App\Http\Controllers\Admin\Super;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\WaClickTracking;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_produk'     => Product::count(),
            'total_portofolio' => Portfolio::count(),
            'total_testimoni'  => Testimonial::count(),
        ];

        /* Klik WA bulan ini vs bulan lalu */
        $now       = now();
        $thisMonth = WaClickTracking::ofMonth($now->year, $now->month)->count();
        $lastMonth = WaClickTracking::ofMonth($now->copy()->subMonth()->year, $now->copy()->subMonth()->month)->count();

        return view('admin.super.dashboard', compact('stats', 'thisMonth', 'lastMonth'));
    }
}
