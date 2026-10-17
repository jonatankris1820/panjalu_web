<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'nama',
        'perusahaan',
        'rating',
        'pesan',
        'foto_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'rating'    => 'integer',
        ];
    }

    /* ── Helper: ambil 2 inisial dari nama ── */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->nama));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->nama, 0, 2));
    }
}
