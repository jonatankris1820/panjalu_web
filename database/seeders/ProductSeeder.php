<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Internet Broadband',
                'slug' => 'internet-broadband',
                'harga_mulai' => 'Rp 199.000/bulan',
                'spesifikasi' => 'Kecepatan hingga 20 Mbps, unlimited data',
                'wa_link' => 'https://wa.me/6281273919000?text=Saya%20tertarik%20dengan%20Internet%20Broadband',
                'cover_image' => 'products/internet-broadband.jpg',
                'deskripsi_singkat' => 'Layanan internet berkecepatan tinggi untuk kebutuhan rumahan dan usaha kecil dengan harga terjangkau.',
                'detail_deskripsi' => 'Dapatkan koneksi internet stabil dengan kecepatan hingga 20 Mbps. Cocok untuk browsing, streaming, dan bekerja dari rumah. Dukungan teknis 24/7 siap membantu Anda.',
                'is_best_seller' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Internet SOHO',
                'slug' => 'internet-soho',
                'harga_mulai' => 'Rp 399.000/bulan',
                'spesifikasi' => 'Kecepatan hingga 50 Mbps, prioritas traffic',
                'wa_link' => 'https://wa.me/6281273919000?text=Saya%20tertarik%20dengan%20Internet%20SOHO',
                'cover_image' => 'products/internet-soho.jpg',
                'deskripsi_singkat' => 'Solusi internet khusus untuk home office dan usaha kecil dengan kestabilan tinggi dan dedicated bandwidth.',
                'detail_deskripsi' => 'Layanan internet SOHO memberikan kecepatan 50 Mbps dengan prioritas traffic untuk memastikan bisnis Anda berjalan lancar. Dilengkapi dengan router profesional dan support teknis prioritas.',
                'is_best_seller' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Internet Dedicated',
                'slug' => 'internet-dedicated',
                'harga_mulai' => 'Rp 799.000/bulan',
                'spesifikasi' => 'Kecepatan hingga 100 Mbps, dedicated line',
                'wa_link' => 'https://wa.me/6281273919000?text=Saya%20tertarik%20dengan%20Internet%20Dedicated',
                'cover_image' => 'products/internet-dedicated.jpg',
                'deskripsi_singkat' => 'Layanan internet dedicated dengan koneksi tidak terbagi, ideal untuk bisnis yang membutuhkan kecepatan dan stabilitas maksimal.',
                'detail_deskripsi' => 'Internet Dedicated menawarkan kecepatan hingga 100 Mbps dengan dedicated line yang tidak dibagi dengan pengguna lain. Koneksi 24/7 dengan uptime guarantee 99.9% dan SLA resmi.',
                'is_best_seller' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Kemitraan RT/RW.Net',
                'slug' => 'kemitraan-rt-rw-net',
                'harga_mulai' => 'Hubungi admin',
                'spesifikasi' => 'Program kemitraan komunitas dengan revenue sharing',
                'wa_link' => 'https://wa.me/6281273919000?text=Saya%20tertarik%20dengan%20program%20kemitraan%20RT/RW.Net',
                'cover_image' => 'products/kemitraan.jpg',
                'deskripsi_singkat' => 'Bergabunglah dengan program kemitraan PT Panjalu untuk memberikan akses internet ke komunitas Anda.',
                'detail_deskripsi' => 'Kami membuka kesempatan kemitraan bagi pegiat RT/RW.Net untuk mengembangkan bisnis internet bersama PT Panjalu dengan model revenue sharing yang menguntungkan. Dukungan infrastruktur penuh dan training gratis.',
                'is_best_seller' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
