<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::create([
            'pertanyaan' => 'Bagaimana Cara Berlangganan Internet?',
            'jawaban'    => 'Hubungi tim PT Panjalu melalui WhatsApp untuk memilih paket dan mendapatkan informasi pemasangan.',
            'is_active'  => true,
            'sort_order' => 1,
        ]);

        Faq::create([
            'pertanyaan' => 'Apakah Layanan Internet Tersedia Di Semua Wilayah?',
            'jawaban'    => 'Ketersediaan layanan bergantung pada jangkauan jaringan di wilayah Anda. Hubungi kami untuk pengecekan lokasi.',
            'is_active'  => true,
            'sort_order' => 2,
        ]);

        Faq::create([
            'pertanyaan' => 'Bagaimana Jika Internetnya Ada Kendala?',
            'jawaban'    => 'Silakan hubungi Customer Service PT Panjalu melalui WhatsApp agar kendala dapat segera ditangani.',
            'is_active'  => true,
            'sort_order' => 3,
        ]);

    }
}
