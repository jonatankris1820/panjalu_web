<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCollab extends Model
{
    protected $fillable = [
        'image_path',
        'alt',
        'sort_order',
    ];
}
