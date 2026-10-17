<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSizeHeader extends Model
{
    protected $fillable = [
        'product_id',
        'headers',
    ];

    protected function casts(): array
    {
        return [
            'headers' => 'array',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
