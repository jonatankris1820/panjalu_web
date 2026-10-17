<footer class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-950 to-violet-950 text-var1 pt-14 pb-5" role="contentinfo" aria-label="Footer utama">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,122,24,0.18),transparent_20%),radial-gradient(circle_at_bottom_right,rgba(124,58,237,0.18),transparent_20%)]"></div>
    <div class="relative max-w-338 mx-auto">
        <div class="grid lg:grid-cols-[2fr_1fr_1.3fr] sm:grid-cols-2 gap-10 xl:px-10 sm:px-8 px-5">
            {{-- Informasi Section --}}
            <div class="max-w-92 lg:space-y-5 space-y-4 sm:col-span-2 lg:col-span-1">
                <img src="{{ asset('images/logo-panjalu_rakerwil-2023.png') }}" alt="Logo PT Panjalu" loading="lazy" width="167" height="94" class="logo-mark h-16 w-auto object-contain">
                <p>PT Panjalu - Wadah informasi, layanan, dan kontak resmi PT Panjalu.</p>
                @php
                    $socials = [
                        ['icon' => 'phone',      'url' => 'https://wa.me/6281273919000',          'label' => 'WhatsApp PT Panjalu'],
                    ];
                @endphp
                <div class="flex items-center gap-5 mt-6">
                    @foreach($socials as $item)
                        <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $item['label'] }}" class="rotate-hover w-11 h-11 rounded-full flex items-center justify-center text-white bg-gradient-to-br from-orange-400 to-violet-500 shadow-[0_10px_30px_rgba(124,58,237,0.35)] hover:scale-105 transition-all duration-200">
                            <i data-lucide="{{ $item['icon'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            
            {{-- Navigasi Section --}}
            <nav class="lg:space-y-5 space-y-4" aria-label="Navigasi cepat">
                <h3 class="text-lg">Navigasi</h3>
                <ul class="flex flex-col gap-3" role="list">
                    @php
                        $footerPages = [
                            ['label' => 'Beranda',       'route' => 'home'],
                            ['label' => 'Produk',        'route' => 'product.index'],
                            ['label' => 'Tentang Kami',  'route' => 'about.index'],
                            ['label' => 'Kontak Kami',   'route' => 'contact.index'],
                        ];
                    @endphp
                    @foreach($footerPages as $page)
                    <li>
                        <a href="{{ route($page['route']) }}" class="relative font-medium transition-all duration-300 group {{ request()->routeIs($page['route']) ? 'text-var1' : 'text-var5 hover:text-var1' }}" {{ request()->routeIs($page['route']) ? 'aria-current=page' : '' }}>
                            {{ $page['label'] }}
                            <span class="absolute left-0 -bottom-0.75 w-full h-[1.5px] bg-var1 rounded scale-x-0 origin-right transition-transform duration-200 ease-in-out group-hover:scale-x-100 group-hover:origin-left {{ request()->routeIs($page['route']) ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>
            
            {{-- Alamat Kami --}}
            <nav class="lg:space-y-5 space-y-4" aria-label="Alamat Kami">
                <h3 class="text-lg">Alamat Kami</h3>
                <ul class="flex flex-col gap-3" role="list">
                    <address class="not-italic">Perum.Green Simpang Lima, Blok A-09, Area Sawah/Kebun, Wonojoyo, Kec. Gurah, Kabupaten Kediri, Jawa Timur 64181</address>
                    <p>Senin-Jumat: 08.00-17.00</p>
                    <p>Sabtu: 08.00-12.00</p>
                </ul>
            </nav>
        </div>
        
        <div class="xl:px-10 sm:px-8 px-5 sm:text-base text-sm">
            <hr class="border-var7 w-full mt-12 mb-5">
            <p>©2026 PT Panjalu. All Rights Reserved.</p>
        </div>
    </div>
</footer>