<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- =========== SEO Meta Tags =========== --}}
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description', 'PT Panjalu — pusat informasi, layanan, dan kontak resmi PT Panjalu.')">
    <meta name="keywords" content="@yield('meta_keywords', 'pt panjalu, informasi pt panjalu, layanan pt panjalu, kontak pt panjalu')">
    <meta name="author" content="PT Panjalu">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- =========== Open Graph / Facebook =========== --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@yield('og_title', 'PT Panjalu')">
    <meta property="og:description" content="@yield('og_description', 'Website resmi PT Panjalu — informasi, layanan, dan kontak resmi.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="PT Panjalu">

    {{-- =========== Twitter Card =========== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'PT Panjalu')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Website resmi PT Panjalu — informasi, layanan, dan kontak resmi.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">

    {{-- =========== Favicon =========== --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}?v=2">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon/favicon.svg') }}?v=2">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}?v=2">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}?v=2">

    {{-- =========== Schema.org / JSON-LD =========== --}}
    @php
        $schemaOrg = [
            '@context' => 'https://schema.org',
            '@type' => ['ClothingStore', 'Organization'],
            'name' => 'PT Panjalu',
            'description' => 'PT Panjalu — informasi, layanan, dan kontak resmi',
            'url' => url('/'),
            'logo' => asset('images/logo-panjalu_rakerwil-2023.png'),
            'image' => asset('images/logo-panjalu_rakerwil-2023.png'),
            'telephone' => '+62-xxx-xxxx-xxxx',
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'ID',
            ],
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($schemaOrg, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    @yield('schema')

    {{-- =========== Main CSS & JS =========== --}}
    @vite(['resources/css/app.css', 'resources/js/public/app.js'])
    {{-- Quick override to ensure primary color shows as a vibrant, living accent before CSS rebuild --}}
    <style>
        .bg-var10 {
            background: linear-gradient(135deg, #ff8a3d 0%, #ff5f6d 32%, #7c3aed 100%) !important;
        }
        .bg-var10.text-var1 { color: #FFFFFF !important; }
        .bg-var10:hover, .hover\:bg-var11:hover {
            background: linear-gradient(135deg, #ff7a18 0%, #ea580c 35%, #6d28d9 100%) !important;
        }
        .border-var10 { border-color: #ff7a18 !important; }
        .text-var10 { color: #ff7a18 !important; }
    </style>
    @yield('head') 
</head>

<body>
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-white focus:p-4 focus:rounded">
        Lewati ke konten utama
    </a>

    {{-- =========== Navbar =========== --}}
    @include('public.layouts.partials.navbar')

    {{-- =========== Main Content =========== --}}
    <main id="main-content" role="main">
        @yield('content')
    </main>

    {{-- =========== Footer =========== --}}
    @include('public.layouts.partials.footer')

    {{-- =========== Fixed WhatsApp Button =========== --}}
    <a href="https://wa.me/6281273919000" id="whatsapp-float" data-wa-source="float" target="_blank" rel="noopener noreferrer" data-aos="fade-right" class="rotate-hover fixed z-[9999] bottom-4 right-4 md:py-3 md:ps-5 md:pe-6 p-3.5 flex items-center gap-2 font-medium text-var1 bg-green-500 hover:bg-green-600 rounded-full hover:duration-300 hover:transition-all" aria-label="Hubungi kami via WhatsApp (membuka tab baru)">
        <svg width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.0781 2.90756C16.1572 1.98193 15.0604 1.24812 13.8516 0.748934C12.6428 0.249746 11.3463 -0.00482601 10.0377 6.92811e-05C4.55424 6.92811e-05 0.0853842 4.44755 0.0803616 9.90754C0.0803616 11.6563 0.53993 13.3575 1.40758 14.8638L0 20L5.27875 18.6225C6.73843 19.4153 8.37488 19.8301 10.0377 19.8288H10.0427C15.5274 19.8288 19.995 15.3813 20 9.91629C20.0011 8.61386 19.7434 7.32409 19.2417 6.12123C18.74 4.91836 18.0056 3.82618 17.0781 2.90756ZM10.0377 18.1513C8.55496 18.1501 7.09973 17.753 5.82371 17.0013L5.52235 16.8213L2.39076 17.6388L3.22702 14.5975L3.03114 14.2838C2.20217 12.9717 1.76375 11.4526 1.7667 9.90254C1.7667 5.37005 5.47966 1.67256 10.0427 1.67256C11.1298 1.67062 12.2065 1.88291 13.2107 2.29718C14.215 2.71145 15.1269 3.31951 15.894 4.08631C16.6636 4.85024 17.2737 5.75823 17.6892 6.75795C18.1047 7.75768 18.3174 8.82938 18.3149 9.91128C18.3099 14.46 14.5969 18.1513 10.0377 18.1513ZM14.5768 11.9838C14.3295 11.86 13.1077 11.2613 12.8779 11.1763C12.6494 11.095 12.4824 11.0525 12.3192 11.3C12.1522 11.5463 11.675 12.1075 11.5319 12.2688C11.3887 12.435 11.2406 12.4538 10.992 12.3313C10.7446 12.2063 9.94224 11.9463 8.99297 11.1C8.25213 10.4438 7.75615 9.63129 7.60798 9.38504C7.46484 9.13754 7.59417 9.00504 7.71848 8.88129C7.82772 8.77129 7.96584 8.59129 8.09015 8.44879C8.21572 8.30629 8.25716 8.20129 8.33877 8.03629C8.42039 7.86879 8.38146 7.72629 8.31994 7.60254C8.25716 7.47879 7.76117 6.25755 7.55148 5.76505C7.35058 5.2788 7.1459 5.3463 6.99272 5.34005C6.84957 5.3313 6.68257 5.3313 6.51557 5.3313C6.38947 5.3345 6.26539 5.36357 6.15109 5.41669C6.0368 5.46982 5.93475 5.54586 5.85133 5.64005C5.6228 5.88755 4.98368 6.4863 4.98368 7.70754C4.98368 8.92879 5.87519 10.1025 6.00075 10.2688C6.12381 10.435 7.75113 12.9338 10.2486 14.0088C10.8388 14.265 11.3034 14.4163 11.6662 14.5313C12.2627 14.7213 12.8014 14.6925 13.2308 14.6313C13.7079 14.5588 14.7012 14.0313 14.9108 13.4525C15.1168 12.8725 15.1168 12.3775 15.054 12.2738C14.9925 12.1688 14.8255 12.1075 14.5768 11.9838Z" fill="white"/></svg>
        <span class="md:flex hidden">Chat Admin via WhatsApp</span>
    </a>

    @stack('scripts')
</body>

</html>
