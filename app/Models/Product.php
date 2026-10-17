<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'harga_mulai',
        'spesifikasi',
        'wa_link',
        'cover_image',
        'deskripsi_singkat',
        'detail_deskripsi',
        'detail_harga_catatan_judul',
        'ukuran_toleransi',
        'is_best_seller',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_best_seller' => 'boolean',
            'is_active'      => 'boolean',
        ];
    }

    /* ── Relationships ── */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function priceTiers(): HasMany
    {
        return $this->hasMany(ProductPriceTier::class)->orderBy('sort_order');
    }

    public function priceNotes(): HasMany
    {
        return $this->hasMany(ProductPriceNote::class)->orderBy('sort_order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class)->orderBy('sort_order');
    }

    public function sizeHeader(): HasOne
    {
        return $this->hasOne(ProductSizeHeader::class);
    }

    public function sizeRows(): HasMany
    {
        return $this->hasMany(ProductSizeRow::class)->orderBy('sort_order');
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class)->orderBy('sort_order');
    }

    /* ── Scopes ── */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBestSeller($query)
    {
        return $query->where('is_best_seller', true)->where('is_active', true);
    }
}
