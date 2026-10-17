<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'nama' => 'Andi Pratama',
                'perusahaan' => 'Pelanggan Rumah',
                'rating' => 5,
                'pesan' => 'Internet dari PT Panjalu cukup stabil untuk kebutuhan sehari-hari. Dipakai untuk belajar, streaming, dan aktivitas online juga nyaman.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'nama' => 'Dimas Saputra',
                'perusahaan' => 'Pemilik Usaha',
                'rating' => 5,
                'pesan' => 'Sejak menggunakan PT Panjalu, koneksi internet di toko kami lebih lancar. Pelayanan pemasangannya juga cepat dan teknisinya membantu.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'nama' => 'Rizky Ramadhan',
                'perusahaan' => 'Freelancer',
                'rating' => 5,
                'pesan' => 'Koneksi internet yang stabil sangat membantu pekerjaan saya. Pelayanannya responsif dan proses pemasangannya juga cukup mudah.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'nama' => 'Yanti Wijaya',
                'perusahaan' => 'Kantor Cabang Kediri',
                'rating' => 4,
                'pesan' => 'Internet dari PT Panjalu digunakan untuk operasional kantor kami. Koneksinya stabil, downtime jarang terjadi, dan support teknis selalu membantu dengan cepat.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'nama' => 'Andi Setiawan',
                'perusahaan' => 'Komunitas RT 02 RW 05',
                'rating' => 5,
                'pesan' => 'Kemitraan RT/RW.Net dengan PT Panjalu membawa manfaat luar biasa untuk komunitas kami. Internet berkualitas dengan harga terjangkau untuk semua warga.',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
