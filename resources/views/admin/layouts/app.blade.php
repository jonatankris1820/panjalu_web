<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Panel Admin') | PT Kaosintim UMKM Indonesia</title>
    
    {{-- =========== Favicon =========== --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

    {{-- =========== Main CSS & JS =========== --}}
    @vite(['resources/css/app.css', 'resources/js/admin/app.js'])
    @yield('head')
</head>

<body class="admin-page bg-var3 font-sans text-var9 antialiased">
    {{-- =========== Sidebar Overlay =========== --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden"></div>

    <div class="flex min-h-screen">
        @include('admin.layouts.partials.sidebar')

        {{-- =========== Main Area =========== --}}
        <div class="flex flex-col flex-1 min-w-0" style="margin-left: 240px;">
            @include('admin.layouts.partials.topbar')

            {{-- Page Content --}}
            <main class="flex-1 p-3 overflow-auto text-[15px]">
                @include('admin.layouts.partials.toast')
                
                @hasSection('breadcrumb')
                    <div class="mb-5">
                        @yield('breadcrumb')
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- =========== Modal Container (untuk CRUD popup) =========== --}}
    <div id="modal-container"></div>

    @stack('scripts')
</body>

</html>