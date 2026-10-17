<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'image_path' => 'portfolio/workshop-umkm.jpg',
                'alt' => 'Workshop Internet untuk UMKM - PT Panjalu',
                'kategori' => 'Event',
                'sort_order' => 1,
            ],
            [
                'image_path' => 'portfolio/csr-internet.jpg',
                'alt' => 'Program CSR Penjangkauan Internet Daerah Terpencil',
                'kategori' => 'Corporate',
                'sort_order' => 2,
            ],
            [
                'image_path' => 'portfolio/digital-summit.jpg',
                'alt' => 'Sponsorship Event Digital Marketing Summit 2024',
                'kategori' => 'Event',
                'sort_order' => 3,
            ],
            [
                'image_path' => 'portfolio/pelatihan-teknis.jpg',
                'alt' => 'Pelatihan Teknis Internet untuk RT/RW.Net',
                'kategori' => 'Event',
                'sort_order' => 4,
            ],
            [
                'image_path' => 'portfolio/kolaborasi-sekolah.jpg',
                'alt' => 'Kolaborasi dengan Sekolah Digital Nasional',
                'kategori' => 'Corporate',
                'sort_order' => 5,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
