@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- =========== Section 1 - Stat Cards =========== --}}
<section class="grid grid-cols-3 gap-3 mb-3">
    @php
        $cards = [
            ['label' => 'Total Produk',     'value' => $stats['total_produk'],     'icon' => 'shirt',                'color' => 'text-blue-500',   'bg' => 'bg-blue-50'],
            ['label' => 'Total Portofolio', 'value' => $stats['total_portofolio'], 'icon' => 'image',                'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
            ['label' => 'Total Testimoni',  'value' => $stats['total_testimoni'],  'icon' => 'message-square-quote', 'color' => 'text-green-500',  'bg' => 'bg-green-50'],
        ];
    @endphp
    @foreach ($cards as $card)
        <div class="bg-var1 rounded-xl border border-var4 p-5 flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl {{ $card['bg'] }} flex items-center justify-center shrink-0">
                <i data-lucide="{{ $card['icon'] }}" class="w-7 h-7 {{ $card['color'] }}"></i>
            </div>
            <div>
                <p class="text-[26px] font-semibold -mb-0.75">{{ $card['value'] }}</p>
                <p class="text-var8">{{ $card['label'] }}</p>
            </div>
        </div>
    @endforeach
</section> {{-- =========== End Section 1 - Stat Cards =========== --}}

{{-- =========== Section 2 - Tracking & Laporan =========== --}}
<section class="bg-var1 rounded-xl border border-var4 p-5">
    {{-- ====== Header ====== --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-xl font-semibold mb-1">Tracking Klik WhatsApp</h2>
            <p class="text-var8">Perbandingan klik tombol WA dari website</p>
        </div>

        {{-- Filter Tahun --}}
        <select id="year-filter" class="border border-var5 rounded-lg px-4 py-2.5 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-200 w-auto cursor-pointer hover:border-var10">
            @foreach ($availableYears as $year)
                <option value="{{ $year }}" {{ $year === now()->year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- ====== Summary Cards ====== --}}
    <div class="grid grid-cols-3 gap-3.5 mb-6 text-var8 text-[15px]">
        <div class="bg-var3 rounded-xl p-5">
            <p class="font-medium mb-1">Bulan Ini</p>
            <p id="summary-this-month" class="text-3xl font-semibold text-blue-500">–</p>
            <p class="mt-0.5 text-sm">total klik</p>
        </div>
        <div class="bg-var3 rounded-xl p-5">
            <p class="font-medium mb-1">Bulan Lalu</p>
            <p id="summary-last-month" class="text-3xl font-semibold text-var9">–</p>
            <p class="mt-0.5 text-sm">total klik</p>
        </div>
        <div class="bg-var3 rounded-xl p-5">
            <p class="font-medium mb-1">Pertumbuhan</p>
            <p id="summary-growth" class="text-3xl font-semibold">–</p>
            <p class="mt-0.5 text-sm">vs bulan lalu</p>
        </div>
    </div>

    {{-- ====== Legend ====== --}}
    <div class="flex items-center gap-5 mb-4 text-sm">
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-green-500 shrink-0"></span>
            <span>Float WA</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-blue-500 shrink-0"></span>
            <span>Kontak Kami</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-red-500 shrink-0"></span>
            <span>Detail Produk</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-var9 shrink-0"></span>
            <span>Total</span>
        </div>
    </div>

    {{-- ====== Chart ====== --}}
    <div class="relative h-72">
        <canvas id="wa-chart" data-url="{{ route('admin.dashboard.chart-data') }}"></canvas>
        <div id="chart-loading" class="absolute inset-0 flex items-center justify-center">
            <div class="flex items-center gap-2 text-var7 text-sm">
                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                Memuat data...
            </div>
        </div>
    </div>

    {{-- ====== Note ====== --}}
    <p class="text-sm mt-5">* Klik yang dicatat: tombol WA melayang, tombol WA di Kontak Kami, dan tombol Order di setiap Detail Produk.</p>
</section> {{-- =========== End Section 2 - Tracking & Laporan =========== --}}

@endsection

@push('scripts')
@vite(['resources/js/admin/modules/dashboard.js'])
@endpush