@extends('public.layouts.main')

@section('title', 'Program & Kegiatan | PT PANJALU')
@section('meta_description', 'Daftar program dan kegiatan PT Panjalu – informasi acara, dokumentasi, dan kolaborasi komunitas.')
@section('meta_keywords', 'program pt panjalu, kegiatan pt panjalu, dokumentasi pt panjalu')

@section('canonical', route('product.index'))
@section('og_title', 'Program & Kegiatan | PT PANJALU')
@section('og_description', 'Lihat program dan kegiatan PT Panjalu.')
@section('og_url', route('product.index'))

@section('content')

{{-- =========== Section 1 - Header Produk =========== --}}
<section class="mt-26 max-w-7xl mx-auto xl:px-10 sm:px-8 px-5" aria-labelledby="produk-heading">
    <x-public.title title="PRODUK KAMI" />

    <div class="text-center mt-10" data-aos="fade-up">
        <h1 id="produk-heading" class="lg:text-5xl md:text-4xl text-3xl lg:leading-12.5 lg:mb-2 mb-3 text-white">Koleksi Program <span class="text-var10">PT Panjalu.</span></h1>
        <p class="lg:text-lg text-white">Temukan berbagai program, workshop, dan kegiatan yang terselenggara dalam PT Panjalu.</p>
    </div>
</section> {{-- =========== End Section 1 - Header Produk =========== --}}

{{-- =========== Section 2 - Grid Produk =========== --}}
<section class="max-w-360 mx-auto lg:mt-10 mt-8 mb-30 xl:px-10 sm:px-8 px-5" aria-label="Daftar program PT Panjalu">
    @if ($products->isEmpty())
        <div class="text-center py-20 text-var7">
            <p class="text-lg">Belum ada produk tersedia.</p>
        </div>
    @else
        <ul class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 lg:gap-6 gap-5 md:max-w-full sm:max-w-120 max-w-110 mx-auto" role="list">
            @foreach ($products as $product)
                <li data-aos="fade-up">
                    <article class="border border-var5 rounded-2xl overflow-hidden h-full">
                        <img src="{{ Storage::url($product->cover_image) }}" alt="Foto produk {{ $product->name }}" loading="{{ $loop->index < 3 ? 'eager' : 'lazy' }}" class="w-full h-80 object-cover object-top">
                        <div class="p-4 space-y-2.5">
                            <h2 class="text-lg -mb-px">{{ $product->name }}</h2>
                            <p>{{ $product->spesifikasi }}</p>
                            <p class="text-xl font-semibold">Mulai dari {{ $product->harga_mulai }}</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="rotate-hover flex items-center justify-center sm:text-lg gap-1 py-2.5 ps-6 pe-5 mt-3.5 font-semibold text-var1 bg-var10 hover:bg-var11 transition-all duration-300 rounded-full" aria-label="Lihat detail produk {{ $product->name }}">
                                Lihat Detail 
                                <i data-lucide="arrow-up-right" aria-hidden="true" class="stroke-2"></i>
                            </a>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>
    @endif
</section> {{-- =========== End Section 2 - Grid Produk =========== --}}

@endsection

@push('scripts')
    @vite(['resources/js/public/modules/product.js'])
@endpush