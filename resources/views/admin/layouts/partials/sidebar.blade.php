@php
    $isSuperAdmin = Auth::user()->isSuperAdmin();
    $currentRoute = Route::currentRouteName();

    $superNavs = [
        ['route' => 'admin.super.dashboard',    'icon' => 'layout-dashboard',  'label' => 'Dashboard'],
        ['route' => 'admin.super.users.index',  'icon' => 'users',             'label' => 'Kelola Akun'],
    ];

    $adminNavs = [
        ['route' => 'admin.dashboard',           'icon' => 'layout-dashboard',      'label' => 'Dashboard'],
        ['route' => 'admin.products.index',      'icon' => 'shirt',                 'label' => 'Manage Produk'],
        ['route' => 'admin.portfolios.index',    'icon' => 'image',                 'label' => 'Manage Portofolio'],
        ['route' => 'admin.testimonials.index',  'icon' => 'message-square-quote',  'label' => 'Manage Testimoni'],
        ['route' => 'admin.faqs.index',          'icon' => 'circle-help',           'label' => 'Manage FAQ'],
        ['route' => 'admin.brands.index',        'icon' => 'building-2',            'label' => 'Manage Brand Colab'],
        ['route' => 'admin.profile.edit',        'icon' => 'circle-user',           'label' => 'Kelola Profile'],
    ];

    $navs = $isSuperAdmin ? $superNavs : $adminNavs;
@endphp

<aside id="sidebar" class="w-60 shrink-0 bg-var1 border-r border-var4 flex flex-col h-screen fixed top-0">
    {{-- Logo --}}
    <div class="flex items-center gap-3 px-6 h-16 border-b border-var4 shrink-0">
        <img src="{{ asset('images/logo-kaosintim-light.svg') }}" alt="Logo Kaosintim" class="h-5.5" loading="lazy">
    </div>

    {{-- Role Badge --}}
    <div class="ps-4 pt-3 pb-3">
        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full {{ $isSuperAdmin ? 'bg-var9 text-var1' : 'bg-red-100 text-var10' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $isSuperAdmin ? 'bg-green-400' : 'bg-var10' }}"></span>
            {{ $isSuperAdmin ? 'Super Admin' : 'Admin' }}
        </span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 pb-4 overflow-y-auto">
        <ul class="space-y-1">
            @foreach ($navs as $nav)
                @php
                    try {
                        $isActive = $currentRoute === $nav['route'] || str_starts_with($currentRoute ?? '', rtrim($nav['route'], '.index'));
                    } catch (\Exception $e) {
                        $isActive = false;
                    }
                @endphp
                <li>
                    @php
                        $routeExists = \Illuminate\Support\Facades\Route::has($nav['route']);
                    @endphp
                    @if ($routeExists)
                        <a href="{{ route($nav['route']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[15px] font-medium transition-all duration-200 {{ $isActive ? 'bg-var10 text-var1' : 'text-var8 hover:bg-var3 hover:text-var9' }}">
                            <i data-lucide="{{ $nav['icon'] }}" class="w-4.5 h-4.5 shrink-0"></i>
                            {{ $nav['label'] }}
                        </a>
                    @else
                        <span class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[15px] font-medium text-var5 cursor-not-allowed">
                            <i data-lucide="{{ $nav['icon'] }}" class="w-4.5 h-4.5 shrink-0"></i>
                            {{ $nav['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>

    {{-- Company Profile Link --}}
    <div class="px-3 pb-3 border-t border-var4 pt-3 space-y-1">
        <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[15px] font-medium text-var8 hover:bg-var3 hover:text-var9 transition-all duration-200">
            <i data-lucide="globe" class="w-4.5 h-4.5 shrink-0"></i>
            Lihat Website
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[15px] font-medium text-var10 hover:bg-red-50 transition-all duration-200 cursor-pointer">
                <i data-lucide="log-out" class="w-4.5 h-4.5 shrink-0"></i>
                Logout
            </button>
        </form>
    </div>
</aside>