<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\WaClickTracking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();

        /* ── Stat Cards ── */
        $stats = [
            'total_produk'     => Product::count(),
            'total_portofolio' => Portfolio::count(),
            'total_testimoni'  => Testimonial::count(),
        ];

        /* ── Tahun tersedia untuk filter (dari data tracking) ── */
        $availableYears = WaClickTracking::selectRaw('YEAR(clicked_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        /* Pastikan tahun ini selalu ada */
        if (! in_array($now->year, $availableYears)) {
            array_unshift($availableYears, $now->year);
        }

        return view('admin.dashboard', compact('stats', 'availableYears'));
    }

    /* ── API: data grafik untuk JS ── */
    public function chartData(Request $request)
    {
        $year = (int) $request->input('year', now()->year);

        $results = WaClickTracking::selectRaw('
                MONTH(clicked_date)  as month,
                source,
                COUNT(*)             as total
            ')
            ->whereYear('clicked_date', $year)
            ->groupBy('month', 'source')
            ->get();

        /* Susun data per bulan (1-12) dan per source */
        $data = [
            'float'   => array_fill(0, 12, 0),
            'contact' => array_fill(0, 12, 0),
            'product' => array_fill(0, 12, 0),
        ];

        foreach ($results as $row) {
            $monthIndex = $row->month - 1; // 0-based
            if (isset($data[$row->source])) {
                $data[$row->source][$monthIndex] = (int) $row->total;
            }
        }

        /* Total per bulan (gabungan semua source) */
        $totals = [];
        for ($i = 0; $i < 12; $i++) {
            $totals[$i] = $data['float'][$i] + $data['contact'][$i] + $data['product'][$i];
        }

        /* Ringkasan bulan ini & bulan lalu */
        $now       = now();
        $thisMonth = WaClickTracking::ofMonth($now->year, $now->month)->count();
        $lastMonth = WaClickTracking::ofMonth(
            $now->copy()->subMonth()->year,
            $now->copy()->subMonth()->month
        )->count();

        $growth = $lastMonth > 0
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1)
            : ($thisMonth > 0 ? 100 : 0);

        return response()->json([
            'labels'    => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'datasets'  => [
                'float'   => array_values($data['float']),
                'contact' => array_values($data['contact']),
                'product' => array_values($data['product']),
                'total'   => array_values($totals),
            ],
            'summary'   => [
                'this_month' => $thisMonth,
                'last_month' => $lastMonth,
                'growth'     => $growth,
            ],
        ]);
    }
}
