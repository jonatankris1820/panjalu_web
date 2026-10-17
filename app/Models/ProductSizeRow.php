<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSizeRow extends Model
{
    protected $fillable = [
        'product_id',
        'label',
        'nilai',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'nilai' => 'array',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
