@extends('admin.layouts.app')

@section('title', 'Dashboard Super Admin')
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

{{-- =========== Section 2 - WA Click Summary =========== --}}
<section class="bg-var1 rounded-xl border border-var4 p-5">
    <h2 class="text-xl font-semibold mb-1">Ringkasan Klik WhatsApp</h2>
    <p class="text-var8 mb-5">Perbandingan klik tombol WA dari website kaosintim</p>
    
    <div class="grid grid-cols-2 gap-3.5 text-var8 text-[15px]">
        <div class="bg-var3 rounded-xl p-5">
            <p class="font-medium mb-1">Bulan Ini</p>
            <p class="text-3xl font-semibold text-var10">{{ $thisMonth }}</p>
            <p class="mt-0.5 text-sm">total klik</p>
        </div>
        <div class="bg-var3 rounded-xl p-5">
            <p class="font-medium mb-1">Bulan Lalu</p>
            <p class="text-3xl font-semibold text-var9">{{ $lastMonth }}</p>
            <p class="mt-0.5 text-sm">total klik</p>
        </div>
    </div>
    <p class="text-sm text-var8 mt-5">* Detail grafik tracking tersedia di panel Admin Kaosintim.</p>
</section> {{-- =========== End Section 2 - WA Click Summary =========== --}}

@endsection