@extends('public.layouts.main')

@section('title', 'PT PANJALU SARANA DATA INDONESIA')
@section('meta_description', 'Website resmi PT Panjalu — pusat informasi, layanan, dan kontak resmi PT Panjalu.')
@section('meta_keywords', 'informasi pt panjalu, layanan pt panjalu, kontak pt panjalu')

@section('canonical', route('home'))
@section('og_title', 'PT PANJALU SARANA DATA INDONESIA')
@section('og_description', 'Website resmi PT Panjalu sebagai pusat informasi dan kolaborasi.')
@section('og_url', route('home'))

@section('content')

{{-- =========== Section 1 - Hero =========== --}}
<section class="bg-hero relative min-h-screen flex items-center py-20" aria-labelledby="hero-heading">
    <div class="w-full max-w-338 mx-auto xl:px-10 sm:px-8 px-5 overflow-hidden">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 lg:gap-16">
            {{-- ===== Left Content ===== --}}
            <div class="flex-1 space-y-6 lg:text-start text-center hero-content">
                <div class="hero-badge inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-white shadow-sm backdrop-blur-sm mx-auto lg:mx-0">
                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_12px_rgba(52,211,153,0.9)]"></span>
                    Pilihan Terbaik
                </div>
                <h1 id="hero-heading" class="xl:text-6xl lg:text-5xl sm:text-4xl text-3xl font-semibold leading-tight hero-heading text-white">PT PANJALU</h1>
                <p class="lg:text-lg sm:text-base text-sm font-medium mx-auto lg:mx-0 hero-subtitle text-white">Sarana Data Indonesia</p>
                <p class="lg:text-lg sm:text-base text-sm max-w-140 mx-auto lg:mx-0 hero-copy text-white/90">Menyediakan solusi internet andal untuk komunitas dan bisnis lokal.</p>
                <p class="lg:text-xl sm:text-lg text-base max-w-140 mx-auto lg:mx-0 hero-copy text-white">Koneksi cepat, stabil, dan siap mendukung aktivitas harian Anda tanpa hambatan.</p>
                <a href="https://wa.me/6281273919000" target="_blank" rel="noopener noreferrer" class="hero-mobile-cta btn-primary w-full sm:w-fit justify-center px-5 py-3" aria-label="Cek jangkauan layanan PT Panjalu via WhatsApp, membuka tab baru">
                    Cek Jangkauan via WhatsApp
                    <i data-lucide="arrow-up-right" class="stroke-2 w-5 h-5" aria-hidden="true"></i>
                </a>
                <hr class="border border-var5 max-w-140 my-4 mx-auto lg:mx-0" aria-hidden="true">
                {{-- Statistik Kami --}}
                <ul class="hero-kpis grid sm:grid-cols-3 gap-4 text-center" aria-label="Statistik perusahaan">
                    @php
                        $statistik = [
                            ['nilai' => '100+', 'label' => 'Telah Dipercaya Ribuan Pelanggan'],
                            ['nilai' => '99%', 'label' => 'Response Admin'],
                            ['nilai' => '100%', 'label' => 'Koneksi Stabil'],
                        ];
                    @endphp
                    @foreach ($statistik as $stat)
                        <li class="rounded-2xl border border-var5/40 bg-white/95 px-4 py-4 shadow-sm backdrop-blur-sm">
                            <div class="text-3xl sm:text-4xl font-semibold text-var10">{{ $stat['nilai'] }}</div>
                            <div class="mt-2 leading-5 text-sm sm:text-base text-gray-800 font-medium">{{ $stat['label'] }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ===== Right Content ===== --}}
            <div class="flex-shrink-0 lg:w-[38rem] w-full flex" aria-hidden="true" data-aos="fade-left">
                <div class="hero-visual relative w-full">
                    <div class="hero-image-frame w-full rounded-[2rem] p-[1px] bg-gradient-to-br from-orange-300 via-violet-400 to-emerald-300 shadow-[0_30px_80px_rgba(15,23,42,0.32)]">
                        <img src="{{ asset('images/ChatGPT Image 2 Sep 2026, 11.17.45.png') }}" alt="Ilustrasi koneksi internet PT Panjalu" loading="eager" class="w-full h-auto rounded-[2rem] border border-var5 object-cover hero-image">
                    </div>
                    <div class="floating-score absolute -right-6 bottom-8 z-10 rounded-3xl border border-violet-200 bg-white/90 p-4 shadow-lg backdrop-blur-sm text-slate-900">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <i data-lucide="wifi" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-[0.18em] text-violet-600">Coverage</div>
                                <div class="text-lg font-bold">99.9%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> {{-- =========== End Section 1 - Hero =========== --}}

{{-- =========== Section 2 - Running Text =========== --}}
<div class="marquee-wrap lg:text-base text-sm py-3.5 bg-var9 text-var1 font-semibold overflow-hidden whitespace-nowrap" aria-hidden="true">
    @php
        $runningTexts = ['TERPERCAYA', 'TERBAIK', 'TERJANGKAU'];
    @endphp
    <div class="marquee-track flex" data-aos="zoom-in">
        @foreach (range(0, 1) as $copy)
            <div class="marquee-group">
                @foreach (range(0, 3) as $repeat)
                    @foreach ($runningTexts as $text)
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <p class="uppercase text-[11px] sm:text-sm">{{ $text }}</p>
                            <i data-lucide="sparkle" class="fill-var1/70 w-4 h-4 sm:w-5 sm:h-5 stroke-0"></i>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
</div> {{-- =========== End Section 2 - Running Text =========== --}}

{{-- =========== Section 3 - Layanan PT Panjalu =========== --}}
<section class="mt-20 overflow-hidden">
    <x-public.title title="LAYANAN PT PANJALU" />

    <div class="grid xl:grid-cols-[1fr_1.2fr] lg:grid-cols-[1fr_1.2fr] lg:gap-10 gap-8 mt-6 max-w-338 mx-auto xl:px-10 sm:px-8 px-5 text-white">
        <div class="service-copy lg:text-lg text-white" data-aos="fade-up">
            <p class="mb-4 text-white"><strong class="text-white">PT PANJALU SARANA DATA INDONESIA</strong> adalah Internet Service Provider di Kabupaten Kediri yang menyediakan internet unlimited dan terjangkau untuk bisnis serta kebutuhan rumahan.</p>

            <ul class="service-list list-disc pl-5 space-y-3 mb-6 text-white">
                <li>
                    <h3 class="text-lg font-semibold text-white">Internet Broadband</h3>
                    <p class="text-white">Internet hemat dan unlimited untuk rumah atau usaha kecil.</p>
                </li>
                <li>
                    <h3 class="text-lg font-semibold text-white">Internet SOHO</h3>
                    <p class="text-white">Koneksi stabil untuk Home Office dan bisnis kecil.</p>
                </li>
                <li>
                    <h3 class="text-lg font-semibold text-white">Internet Dedicated</h3>
                    <p class="text-white">Koneksi khusus untuk bisnis yang membutuhkan kecepatan dan kestabilan tinggi.</p>
                </li>
                <li>
                    <h3 class="text-lg font-semibold text-white">Kemitraan</h3>
                    <p class="text-white">Kemitraan bagi pegiat RT/RW.Net untuk mengembangkan usaha sebagai subnet PT Panjalu.</p>
                </li>
            </ul>
        </div>

            <div class="service-panel self-start h-fit hidden lg:block" style="align-self:flex-start;height:max-content;min-height:0;" data-aos="fade-left">
            <span class="floating-badge">Trusted ISP</span>
            <img src="{{ asset('images/technician-transparent.png') }}" alt="Teknisi PT Panjalu memasang perangkat jaringan" loading="lazy" class="w-full max-w-[34rem] mx-auto h-auto object-contain">
        </div>
    </div>
</section> {{-- =========== End Section 3 - Layanan PT Panjalu =========== --}}

{{-- =========== Section 5 - Garansi Kami =========== --}}
<section class="mt-30" aria-labelledby="garansi-heading">
    {{-- Label --}}
    <x-public.title title="3 JAMINAN DARI KAMI" />

    {{-- Content --}}
    <div class="max-w-338 mx-auto mt-9 xl:px-10 sm:px-8 px-5">
        <h2 id="garansi-heading" class="lg:text-5xl md:text-4xl text-3xl lg:leading-12.5 mb-2 text-center px-5 text-var1" data-aos="fade-up">Nilai Yang <span class="text-var10">Kami Jaga.</span></h2>
    
        <ul class="grid lg:grid-cols-3 md:gap-6 gap-5 mt-8">
            @php
                $garansi = [
                    ['icon' => 'shield-check',     'judul' => 'Kualitas Terjaga',     'deskripsi' => 'Kami berkomitmen memberikan layanan internet yang stabil dan berkualitas.'], 
                    ['icon' => 'clipboard-check',  'judul' => 'Informasi Terukur',   'deskripsi' => 'Kami memberikan informasi layanan secara jelas, lengkap, dan mudah dipahami.'], 
                    ['icon' => 'clock',            'judul' => 'Layanan Responsif',  'deskripsi' => 'Bantuan cepat untuk menjaga koneksi tetap optimal.'], 
                ];
            @endphp
            @foreach ($garansi as $i => $item)
                <li class="relative bg-var2 rounded-2xl lg:text-lg lg:p-6 sm:p-5 p-4 rotate-hover group" data-aos="fade-up" data-aos-delay="400">
                    <div class="lg:w-16 w-15 lg:h-16 h-15 flex items-center justify-center bg-var4 rounded-xl group-hover:bg-var9 group-hover:text-var1 transition-all duration-300" aria-hidden="true">
                        <i data-lucide="{{ $item['icon'] }}" class="lg:w-9 w-8 lg:h-9 h-8"></i>
                    </div>
                    <h3 class="lg:text-xl text-lg mt-5 sm:mb-2 mb-1">{{ $item['judul'] }}</h3>
                    <p>{{ $item['deskripsi'] }}</p>
                    <span class="absolute top-5.5 right-6 text-var4 lg:text-6xl text-5xl font-semibold group-hover:text-var6 transition-all duration-300" aria-hidden="true">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section> {{-- =========== End Section 5 - Garansi Kami =========== --}}

{{-- =========== Section 7 - Keunggulan Kami =========== --}}
<section class="max-w-338 mx-auto xl:px-10 sm:px-8 px-5 mt-30" aria-labelledby="keunggulan-heading">
    <x-public.title title="KEUNGGULAN KAMI" />

    <div class="mt-9 overflow-hidden">
        <h2 id="keunggulan-heading" class="lg:text-5xl md:text-4xl text-3xl lg:leading-12.5 mb-2 text-center px-5 text-var1" data-aos="fade-up">Kenapa <span class="text-var10">PT Panjalu</span> Menjadi Pilihan?</h2>

         @php
            $keunggulanUtama = [
                ['icon' => 'wifi',      'aos' => 'fade-right', 'judul' => 'Internet Stabil & Terpercaya',       'style' => 'featured', 'deskripsi' => 'Koneksi internet yang stabil untuk mendukung kebutuhan rumah, sekolah, maupun bisnis.'],
                ['icon' => 'package',   'aos' => 'fade-left',  'judul' => 'Pilihan Paket Sesuai Kebutuhan',    'style' => 'default',  'deskripsi' => 'Tersedia berbagai pilihan kecepatan internet yang dapat disesuaikan dengan kebutuhan Anda.'],
            ];

            $keunggulanLainnya = [
                ['icon' => 'wrench',       'judul' => 'Pemasangan Cepat & Profesional',   'style' => 'default', 'deskripsi' => 'Proses pemasangan dilakukan oleh teknisi yang berpengalaman dan siap membantu Anda.'],
                ['icon' => 'headset',      'judul' => 'Layanan Pelanggan Responsif',      'style' => 'default', 'deskripsi' => 'Tim kami siap membantu menangani pertanyaan dan kendala layanan internet Anda.'],
                ['icon' => 'badge-percent', 'judul' => 'Harga Terjangkau',                'style' => 'accent',  'deskripsi' => 'Nikmati koneksi internet berkualitas dengan pilihan paket yang sesuai dengan kebutuhan dan budget Anda.'],
            ];
        @endphp

        {{-- Baris 1: 2 kolom --}}
        <ul class="grid lg:grid-cols-[2fr_1.5fr] md:gap-6 gap-5 mt-8">
            @foreach ($keunggulanUtama as $item)
                @if ($item['style'] === 'featured')
                    <li class="bg-var9 text-var1 rounded-2xl lg:text-lg lg:p-6 sm:p-5 p-4 rotate-hover group" data-aos="{{ $item['aos'] }}">
                        <div class="lg:w-16 w-15 lg:h-16 h-15 flex items-center justify-center bg-var1 text-var9 rounded-xl group-hover:bg-var6 group-hover:text-var1 transition-all duration-300" aria-hidden="true">
                            <i data-lucide="{{ $item['icon'] }}" class="lg:w-9 w-8 lg:h-9 h-8"></i>
                        </div>
                        <h3 class="lg:text-xl text-lg mt-5 sm:mb-2 mb-1">{{ $item['judul'] }}</h3>
                        <p class="max-w-150">{{ $item['deskripsi'] }}</p>
                    </li>
                @else
                    <li class="bg-var2 rounded-2xl lg:text-lg lg:p-6 sm:p-5 p-4 rotate-hover group" data-aos="{{ $item['aos'] }}">
                        <div class="lg:w-16 w-15 lg:h-16 h-15 flex items-center justify-center bg-var4 rounded-xl group-hover:bg-var9 group-hover:text-var1 transition-all duration-300" aria-hidden="true">
                            <i data-lucide="{{ $item['icon'] }}" class="lg:w-9 w-8 lg:h-9 h-8"></i>
                        </div>
                        <h3 class="lg:text-xl text-lg mt-5 sm:mb-2 mb-1">{{ $item['judul'] }}</h3>
                        <p>{{ $item['deskripsi'] }}</p>
                    </li>
                @endif
            @endforeach
        </ul>

        {{-- Baris 2: 3 kolom --}}
        <ul class="grid lg:grid-cols-3 md:gap-6 gap-5 md:mt-6 mt-5">
            @foreach ($keunggulanLainnya as $item)
                @if ($item['style'] === 'accent')
                    <li class="bg-var10 text-var1 rounded-2xl lg:text-lg lg:p-6 sm:p-5 p-4 rotate-hover group" data-aos="fade-up">
                        <div class="lg:w-16 w-15 lg:h-16 h-15 flex items-center justify-center bg-var1 text-var9 rounded-xl group-hover:bg-red-400 group-hover:text-var1 transition-all duration-300" aria-hidden="true">
                            <i data-lucide="{{ $item['icon'] }}" class="lg:w-9 w-8 lg:h-9 h-8"></i>
                        </div>
                        <h3 class="lg:text-xl text-lg mt-5 sm:mb-2 mb-1">{{ $item['judul'] }}</h3>
                        <p>{{ $item['deskripsi'] }}</p>
                    </li>
                @else
                    <li class="bg-var2 rounded-2xl lg:text-lg lg:p-6 sm:p-5 p-4 rotate-hover group" data-aos="fade-up">
                        <div class="lg:w-16 w-15 lg:h-16 h-15 flex items-center justify-center bg-var4 rounded-xl group-hover:bg-var9 group-hover:text-var1 transition-all duration-300" aria-hidden="true">
                            <i data-lucide="{{ $item['icon'] }}" class="lg:w-9 w-8 lg:h-9 h-8"></i>
                        </div>
                        <h3 class="lg:text-xl text-lg mt-5 sm:mb-2 mb-1">{{ $item['judul'] }}</h3>
                        <p>{{ $item['deskripsi'] }}</p>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</section> {{-- =========== Section 7 - Keunggulan Kami =========== --}}

{{-- =========== Section 8 - Testimoni Klien =========== --}}
<section class="mt-30 text-var1" aria-labelledby="testimoni-heading">
    <x-public.title title="TESTIMONI" />

    <div class="max-w-357 mx-auto xl:px-10 sm:px-8 px-5 mt-9">
        <h2 id="testimoni-heading" class="lg:text-5xl md:text-4xl text-3xl lg:leading-12.5 mb-2 text-center px-5" data-aos="fade-up">Apa Kata Pelanggan <span class="text-var10">PT PANJALU?</span></h2>

        @php
            $totalHalaman   = count($chunks);
            $totalHalamanMd = count($chunksMd);
        @endphp
        {{-- ===== Carousel LG: 3 kolom, 3 per halaman ===== --}}
        <div id="testimoni-carousel-lg" class="hidden lg:block relative mt-8 xl:px-10 sm:px-8 px-5" data-aos="fade-up" role="region" aria-roledescription="carousel" aria-label="Testimoni pelanggan">
            <div class="relative">
                <button id="btn-prev-lg" type="button" class="rotate-hover z-1 absolute flex items-center justify-center inset-y-1/2 -translate-y-1/2 sm:-left-11 -left-8 bg-var4 hover:bg-var9 hover:text-var1 rounded-full lg:w-14 w-13 lg:h-14 h-13 cursor-pointer transition-all duration-300" aria-label="Testimoni sebelumnya">
                    <i data-lucide="arrow-left" class="lg:w-7 w-6 lg:h-7 h-6" aria-hidden="true"></i>
                </button>
                <button id="btn-next-lg" type="button" class="rotate-hover z-1 absolute flex items-center justify-center inset-y-1/2 -translate-y-1/2 sm:-right-11 -right-8 bg-var4 hover:bg-var9 hover:text-var1 rounded-full lg:w-14 w-13 lg:h-14 h-13 cursor-pointer transition-all duration-300" aria-label="Testimoni berikutnya">
                    <i data-lucide="arrow-right" class="lg:w-7 w-6 lg:h-7 h-6" aria-hidden="true"></i>
                </button>
                <div aria-live="polite" aria-atomic="false">
                    @foreach ($chunks as $pageIndex => $page)
                        <div class="testimoni-page grid grid-cols-3 gap-6 transition-opacity duration-500" style="{{ $pageIndex === 0 ? 'opacity:1;' : 'opacity:0; position:absolute; top:0; left:0; pointer-events:none;' }}" aria-hidden="{{ $pageIndex === 0 ? 'false' : 'true' }}">
                            @foreach ($page as $item)
                                <article class="border border-var5 rounded-2xl lg:text-lg p-6 flex flex-col h-full" aria-label="Testimoni dari {{ $item['nama'] }}, bintang {{ $item['rating'] }}">
                                    <div class="flex items-center gap-1.5 mb-5" role="img" aria-label="Rating {{ $item['rating'] }} dari 5 bintang">
                                        @for ($s = 1; $s <= 5; $s++)
                                            <i data-lucide="star" class="w-4 h-4 {{ $s <= $item['rating'] ? 'text-amber-400 fill-amber-400' : 'text-var5' }}" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <blockquote class="flex flex-col h-full">
                                        <p class="mb-4">"{{ $item['pesan'] }}"</p>
                                        <footer class="flex items-center gap-3.5 mt-auto">
                                            <div class="bg-var10 text-var1 flex items-center justify-center h-12 w-12 rounded-full font-semibold shrink-0">{{ $item['inisial'] }}</div>
                                            <div>
                                                <cite class="font-semibold not-italic -mb-0.5 block">{{ $item['nama'] }}</cite>
                                                <p class="text-base">{{ $item['alamat'] }}</p>
                                            </div>
                                        </footer>
                                    </blockquote>
                                </article>
                            @endforeach
                            @for ($p = count($page); $p < 3; $p++)
                                <div aria-hidden="true"></div>
                            @endfor
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-center items-center gap-2 mt-6" role="group" aria-label="Pilih halaman testimoni">
                @for ($d = 0; $d < $totalHalaman; $d++)
                    <button type="button" aria-label="Halaman {{ $d + 1 }}" aria-current="{{ $d === 0 ? 'true' : 'false' }}" class="testimoni-dot w-3 h-3 rounded-full cursor-pointer transition-all duration-300 {{ $d === 0 ? 'bg-var9' : 'bg-var4' }}" data-index="{{ $d }}"></button>
                @endfor
            </div>
        </div>

        {{-- ===== Carousel MD: 2 kolom, 4 per halaman ===== --}}
        <div id="testimoni-carousel-md" class="hidden md:block lg:hidden relative mt-8 xl:px-10 sm:px-8 px-5" data-aos="fade-up" role="region" aria-roledescription="carousel" aria-label="Testimoni pelanggan">
            <div class="relative">
                <button id="btn-prev-md" type="button" class="rotate-hover z-1 absolute flex items-center justify-center inset-y-1/2 -translate-y-1/2 sm:-left-11 -left-8 bg-var4 hover:bg-var9 hover:text-var1 rounded-full w-13 h-13 cursor-pointer transition-all duration-300" aria-label="Testimoni sebelumnya">
                    <i data-lucide="arrow-left" class="w-6 h-6" aria-hidden="true"></i>
                </button>
                <button id="btn-next-md" type="button" class="rotate-hover z-1 absolute flex items-center justify-center inset-y-1/2 -translate-y-1/2 sm:-right-11 -right-8 bg-var4 hover:bg-var9 hover:text-var1 rounded-full w-13 h-13 cursor-pointer transition-all duration-300" aria-label="Testimoni berikutnya">
                    <i data-lucide="arrow-right" class="w-6 h-6" aria-hidden="true"></i>
                </button>
                <div aria-live="polite" aria-atomic="false">
                    @foreach ($chunksMd as $pageIndex => $page)
                        <div class="testimoni-page grid grid-cols-2 gap-5 transition-opacity duration-500" style="{{ $pageIndex === 0 ? 'opacity:1;' : 'opacity:0; position:absolute; top:0; left:0; pointer-events:none;' }}" aria-hidden="{{ $pageIndex === 0 ? 'false' : 'true' }}">
                            @foreach ($page as $item)
                                <article class="border border-var5 rounded-2xl lg:text-lg p-6 flex flex-col h-full" aria-label="Testimoni dari {{ $item['nama'] }}, bintang {{ $item['rating'] }}">
                                    <div class="flex items-center gap-1.5 mb-5" role="img" aria-label="Rating {{ $item['rating'] }} dari 5 bintang">
                                        @for ($s = 1; $s <= 5; $s++)
                                            <i data-lucide="star" class="w-4 h-4 {{ $s <= $item['rating'] ? 'text-amber-400 fill-amber-400' : 'text-var5' }}" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <blockquote class="flex flex-col h-full">
                                        <p class="mb-4">"{{ $item['pesan'] }}"</p>
                                        <footer class="flex items-center gap-3 mt-auto">
                                            <div class="bg-var10 text-var1 flex items-center justify-center h-12 w-12 rounded-full font-semibold shrink-0">{{ $item['inisial'] }}</div>
                                            <div>
                                                <cite class="font-semibold not-italic block">{{ $item['nama'] }}</cite>
                                                <p class="text-sm">{{ $item['alamat'] }}</p>
                                            </div>
                                        </footer>
                                    </blockquote>
                                </article>
                            @endforeach
                            @for ($p = count($page); $p < 4; $p++)
                                <div aria-hidden="true"></div>
                            @endfor
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-center items-center gap-2 mt-6" role="group" aria-label="Pilih halaman testimoni">
                @for ($d = 0; $d < $totalHalamanMd; $d++)
                    <button type="button" aria-label="Halaman {{ $d + 1 }}" aria-current="{{ $d === 0 ? 'true' : 'false' }}" class="testimoni-dot w-3 h-3 rounded-full cursor-pointer transition-all duration-300 {{ $d === 0 ? 'bg-var9' : 'bg-var4' }}" data-index="{{ $d }}"></button>
                @endfor
            </div>
        </div>

        {{-- ===== Carousel XS: 1 kolom, 3 per halaman ===== --}}
        <div id="testimoni-carousel-xs" class="md:hidden relative mt-8 sm:px-8 px-5" data-aos="fade-up" role="region" aria-roledescription="carousel" aria-label="Testimoni pelanggan">
            <div class="relative">
                <button id="btn-prev-xs" type="button" class="rotate-hover z-1 absolute flex items-center justify-center inset-y-1/2 -translate-y-1/2 -left-8 bg-var4 hover:bg-var9 hover:text-var1 rounded-full w-13 h-13 cursor-pointer transition-all duration-300" aria-label="Testimoni sebelumnya">
                    <i data-lucide="arrow-left" class="w-6 h-6" aria-hidden="true"></i>
                </button>
                <button id="btn-next-xs" type="button" class="rotate-hover z-1 absolute flex items-center justify-center inset-y-1/2 -translate-y-1/2 -right-8 bg-var4 hover:bg-var9 hover:text-var1 rounded-full w-13 h-13 cursor-pointer transition-all duration-300" aria-label="Testimoni berikutnya">
                    <i data-lucide="arrow-right" class="w-6 h-6" aria-hidden="true"></i>
                </button>
                <div aria-live="polite" aria-atomic="false">
                    @foreach ($chunks as $pageIndex => $page)
                        <div class="testimoni-page grid grid-cols-1 gap-5 transition-opacity duration-500" style="{{ $pageIndex === 0 ? 'opacity:1;' : 'opacity:0; position:absolute; top:0; left:0; pointer-events:none;' }}" aria-hidden="{{ $pageIndex === 0 ? 'false' : 'true' }}">
                            @foreach ($page as $item)
                                <article class="border border-var5 rounded-2xl p-6 flex flex-col h-full" aria-label="Testimoni dari {{ $item['nama'] }}, bintang {{ $item['rating'] }}">
                                    <div class="flex items-center gap-1.5 mb-5" role="img" aria-label="Rating {{ $item['rating'] }} dari 5 bintang">
                                        @for ($s = 1; $s <= 5; $s++)
                                            <i data-lucide="star" class="w-4 h-4 {{ $s <= $item['rating'] ? 'text-amber-400 fill-amber-400' : 'text-var5' }}" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <blockquote class="flex flex-col h-full">
                                        <p class="mb-4">"{{ $item['pesan'] }}"</p>
                                        <footer class="flex items-center gap-3 mt-auto">
                                            <div class="bg-var10 text-var1 flex items-center justify-center h-12 w-12 rounded-full font-semibold shrink-0">{{ $item['inisial'] }}</div>
                                            <div>
                                                <cite class="font-semibold not-italic block">{{ $item['nama'] }}</cite>
                                                <p class="text-sm">{{ $item['alamat'] }}</p>
                                            </div>
                                        </footer>
                                    </blockquote>
                                </article>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-center items-center gap-2 mt-6" role="group" aria-label="Pilih halaman testimoni">
                @for ($d = 0; $d < $totalHalaman; $d++)
                    <button type="button" aria-label="Halaman {{ $d + 1 }}" aria-current="{{ $d === 0 ? 'true' : 'false' }}" class="testimoni-dot w-3 h-3 rounded-full cursor-pointer transition-all duration-300 {{ $d === 0 ? 'bg-var9' : 'bg-var4' }}" data-index="{{ $d }}"></button>
                @endfor
            </div>
        </div>
    </div>
</section> {{-- =========== End Section 8 - Testimoni Klien =========== --}}

{{-- =========== Section 9 - Banner Kolaborasi =========== --}}
<section class="cta-banner bg-var9 text-var1 text-center lg:text-xl md:text-lg mt-30 space-y-3 lg:py-16 md:py-14 py-12 px-5" aria-labelledby="cta-heading" data-aos="fade-up">
    <div class="cta-badge">Ayo mulai hari ini</div>
    <h2 id="cta-heading" class="lg:text-5xl md:text-4xl text-3xl">Ayo Nikmati Promo-Promo Spesial dari PANJALU</h2>
    <p>Hubungi kami untuk informasi layanan, dukungan, atau kebutuhan terkait PT Panjalu.</p>
    <a href="https://wa.me/6281273919000" target="_blank" rel="noopener noreferrer" class="rotate-hover w-fit lg:py-4 py-3.5 lg:text-xl text-lg px-14 md:mt-8 mt-6 mx-auto flex items-center gap-2 justify-center bg-var1 text-var9 font-semibold rounded-full hover:bg-var5 transition-all duration-300" aria-label="Hubungi PT Panjalu via WhatsApp, membuka tab baru">
        Hubungi Kami
        <i data-lucide="arrow-up-right" class="stroke-2 w-6.5 h-6.5" aria-hidden="true"></i>
    </a>
</section> {{-- =========== Section 9 - Banner Kolaborasi =========== --}}

{{-- =========== Section 10 - FAQ Klien =========== --}}
<section aria-labelledby="faq-heading" class="my-30">
    <x-public.title title="FAQ KLIEN" />

    <div class="max-w-338 mx-auto xl:px-10 sm:px-8 px-5 mt-9">
        <h2 id="faq-heading" data-aos="fade-up" class="lg:text-5xl md:text-4xl text-3xl md:leading-12.5 mb-2 text-center text-var1">Pertanyaan Yang <span class="text-var10">Sering Diajukan.</span></h2>

        <dl class="mt-8 space-y-5">
        @forelse ($faqDb as $i => $faq)
            <div class="faq-item bg-white lg:text-lg rounded-none px-8 shadow-sm overflow-hidden" data-aos="fade-up">
                <dt>
                    <button type="button" id="faq-q{{ $i + 1 }}" class="faq-btn flex justify-between items-center gap-4 w-full cursor-pointer text-var9 hover:text-var10 transition-colors duration-300 py-7" aria-expanded="false" aria-controls="faq-a{{ $i + 1 }}">
                        <span class="lg:text-2xl text-xl text-left font-semibold">{{ $faq->pertanyaan }}</span>
                        <i data-lucide="chevrons-right" class="faq-icon md:w-7 w-6 md:h-7 h-6 shrink-0" aria-hidden="true"></i>
                    </button>
                </dt>
                <dd id="faq-a{{ $i + 1 }}" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out" style="max-height: 0; opacity: 0;" aria-labelledby="faq-q{{ $i + 1 }}">
                    <p class="pb-5">{{ $faq->jawaban }}</p>
                </dd>
            </div>
        @empty
            <div class="col-span-3 text-center py-10 text-var7">
                <p>Belum ada FAQ pertanyaan yang sering diajukan.</p>
            </div>
        @endforelse
    </dl>
    </div>
</section> {{-- =========== Section 10 - FAQ Klien =========== --}}

@endsection

@push('scripts')
@vite(['resources/js/public/modules/home.js'])
@endpush