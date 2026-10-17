<?php

namespace Database\Seeders;

use App\Models\BrandCollab;
use Illuminate\Database\Seeder;

class BrandCollabSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'image_path' => 'brands/brand-1.png',
                'alt' => 'Partner Brand 1',
                'sort_order' => 1,
            ],
            [
                'image_path' => 'brands/brand-2.png',
                'alt' => 'Partner Brand 2',
                'sort_order' => 2,
            ],
            [
                'image_path' => 'brands/brand-3.png',
                'alt' => 'Partner Brand 3',
                'sort_order' => 3,
            ],
            [
                'image_path' => 'brands/brand-4.png',
                'alt' => 'Partner Brand 4',
                'sort_order' => 4,
            ],
            [
                'image_path' => 'brands/brand-5.png',
                'alt' => 'Partner Brand 5',
                'sort_order' => 5,
            ],
        ];

        foreach ($brands as $brand) {
            BrandCollab::create($brand);
        }
    }
}
