<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'image_path',
        'alt',
        'kategori',
        'sort_order',
    ];
}
