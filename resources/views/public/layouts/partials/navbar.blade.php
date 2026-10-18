<header id="navbar" role="banner" class="navbar fixed w-full top-0 flex items-center justify-between z-99 xl:px-17 lg:px-12 px-8 lg:pt-3 pt-3 lg:pb-3 pb-3" aria-label="Header utama">
    {{-- ===== Logo PT Panjalu ===== --}}
    <a href="{{ route('home') }}" aria-label="PT Panjalu - Kembali ke Beranda" class="inline-flex items-center rounded-[2rem] border-0 bg-transparent p-0 transition-transform duration-300 hover:scale-[1.02]">
        <img src="{{ asset('images/logo-panjalu_rakerwil-2023.png') }}" alt="Logo PT Panjalu" loading="eager" width="167" height="94" class="logo-mark lg:w-32 w-28 h-auto object-contain" role="presentation">
    </a>

    {{-- ===== Navigation Menu Desktop ===== --}}
    <nav class="hidden lg:flex items-center" role="navigation" aria-label="Navigasi utama">
        <ul class="flex items-center gap-10" role="list">
            @php
                $navLinks = [
                    ['label' => 'Beranda',       'route' => 'home',             'match' => 'home'],
                    ['label' => 'Tentang Kami',  'route' => 'about.index',      'match' => 'about.*'],
                    ['label' => 'Kontak Kami',   'route' => 'contact.index',    'match' => 'contact.*'],
                ];
                $isActive = fn($link) => request()->routeIs($link['route']) || request()->routeIs($link['match']);
            @endphp
            @foreach($navLinks as $link)
                <li>
                    <a href="{{ $link['url'] ?? route($link['route']) }}" class="relative font-medium transition-colors duration-300 group {{ $isActive($link) ? 'text-var10' : 'text-var9 hover:text-var10' }}" @if($isActive($link)) aria-current="page" @endif>
                        {{ $link['label'] }}
                        <span class="absolute left-0 -bottom-0.75 w-full h-[1.5px] bg-var10 rounded origin-right transition-transform duration-200 ease-in-out group-hover:scale-x-100 group-hover:origin-left {{ $isActive($link) ? 'scale-x-100' : 'scale-x-0' }}"></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    {{-- ===== Hamburger Button Mobile ===== --}}
    <button id="hamburger" type="button" class="hamburger lg:hidden flex flex-col justify-center items-center w-8 h-8 space-y-1.5 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-var10 focus-visible:rounded" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-menu">
        <span class="hamburger-line line1" aria-hidden="true"></span>
        <span class="hamburger-line line2" aria-hidden="true"></span>
        <span class="hamburger-line line3" aria-hidden="true"></span>
    </button>
</header>

{{-- =========== Mobile Menu =========== --}}
<div id="mobile-menu" class="mobile-menu lg:hidden flex flex-col overflow-y-auto px-9 pb-9" role="dialog" aria-modal="true" aria-label="Menu navigasi mobile" aria-hidden="true">
    <nav class="w-full mt-26" role="navigation" aria-label="Navigasi utama mobile">
        <ul class="space-y-5" role="list">
            @foreach($navLinks as $index => $link)
                @php $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT); @endphp
                <li class="mobile-menu-item flex items-center group w-fit" role="listitem">
                    <span class="text-var10 text-base font-semibold max-w-0 opacity-0 overflow-hidden translate-x-4 transition-all duration-700 group-hover:max-w-10 group-hover:opacity-100 group-hover:translate-x-0" aria-hidden="true">{{ $num }}</span>
                    <a href="{{ route($link['route']) }}" class="text-4xl font-semibold transition-all duration-500 group-hover:translate-x-3 {{ $isActive($link) ? 'text-var10' : 'text-var9 hover:text-var10' }}" @if($isActive($link)) aria-current="page" @endif>
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <a href="https://wa.me/6281273919000" target="_blank" rel="noopener noreferrer" class="mobile-menu-item-cta rotate-hover w-full text-lg py-3 px-14 mt-10 mx-auto flex items-center gap-2 justify-center bg-var10 text-var1 font-semibold rounded-full hover:bg-var11 transition-all duration-300" aria-label="Hubungi PT Panjalu via WhatsApp, membuka tab baru">
        Hubungi Kami
        <i data-lucide="headset" class="stroke-2 w-6.5 h-6.5" aria-hidden="true"></i>
    </a>

    <p class="mobile-menu-item-footer mt-auto text-center text-sm font-medium">©2026 PT Panjalu. All Rights Reserved.</p>
</div> {{-- =========== End Mobile Menu =========== --}}