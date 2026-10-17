<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        /* Best seller dari DB */
        $bestSellers = Product::bestSeller()->orderBy('sort_order')->take(3)->get();

        /* Testimoni dari DB — fallback ke array statis jika DB kosong */
        $testimoniDb = Testimonial::where('is_active', true)->orderBy('sort_order')->get();

        if ($testimoniDb->count() > 0) {
            $testimoni = $testimoniDb->map(fn($t) => [
                'nama'    => $t->nama,
                'inisial' => $t->initials,
                'alamat'  => $t->perusahaan ?? '',
                'rating'  => $t->rating,
                'pesan'   => $t->pesan,
            ])->toArray();
        } else {
            /* Fallback data statis lama */
            $testimoni = [
                ['nama' => 'Indra Maulana', 'inisial' => 'IM', 'alamat' => 'The Village', 'rating' => 5, 'pesan' => 'Pelayanan ramah, proses sangat cepat, aman dan terpercaya, Awesome cocok untuk pembuatan seragam'],
                ['nama' => 'Deni Kusuma',   'inisial' => 'DK', 'alamat' => 'Dennyproperty', 'rating' => 5, 'pesan' => 'Kualitas bagus semua seragam dan design nya, harga terjangkau kualitas tidak di ragukan lagi, Sukses selalu Kaosintim'],
            ];
        }

        /* FAQ dari DB — fallback ke statis jika DB kosong */
        $faqDb = Faq::where('is_active', true)->orderBy('sort_order')->get()->unique('sort_order')->take(3)->values();

        $perHalaman   = 3;
        $perHalamanMd = 4;
        $chunks       = array_chunk($testimoni, $perHalaman);
        $chunksMd     = array_chunk($testimoni, $perHalamanMd);

        return view('public.pages.index', compact('testimoni', 'chunks', 'chunksMd', 'bestSellers', 'faqDb'));
    }
}
