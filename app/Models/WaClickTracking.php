<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaClickTracking extends Model
{
    protected $fillable = [
        'source',
        'product_slug',
        'clicked_date',
    ];

    protected function casts(): array
    {
        return [
            'clicked_date' => 'date',
        ];
    }

    /* ── Scope: filter per bulan & tahun ── */
    public function scopeOfMonth($query, int $year, int $month)
    {
        return $query->whereYear('clicked_date', $year)
            ->whereMonth('clicked_date', $month);
    }

    public function scopeOfYear($query, int $year)
    {
        return $query->whereYear('clicked_date', $year);
    }
}
