@extends('public.layouts.main')

@section('title', $product->name . ' | PT PANJALU')
@section('meta_description', $product->deskripsi_singkat ?? 'Detail program atau layanan PT Panjalu.')
@section('meta_keywords', 'detail program pt panjalu, ' . $product->name . ', pt panjalu')

@section('canonical', route('product.show', $product->slug))
@section('og_title', $product->name . ' | PT PANJALU')
@section('og_description', $product->deskripsi_singkat ?? '')
@section('og_url', route('product.show', $product->slug))
@section('og_type', 'product')

@section('content')

{{-- =========== Section 1 - Detail Produk =========== --}}
<section class="lg:grid lg:grid-cols-[1.3fr_2fr] flex flex-col xl:gap-12 lg:gap-10 gap-8 max-w-338 mx-auto xl:px-10 sm:px-8 px-5 my-26 overflow-hidden" aria-labelledby="detail-heading">
    {{-- ====== Left: Galeri Gambar ====== --}}
    @php
        $allImages = collect([['path' => $product->cover_image, 'alt' => 'Foto utama produk ' . $product->name]])->merge($product->images->map(fn($img) => ['path' => $img->image_path, 'alt' => 'Foto produk ' . $product->name]))->values();
    @endphp
    <div class="lg:w-full md:w-160 sm:w-140 w-full mx-auto flex lg:flex-col sm:flex-row flex-col lg:gap-0 gap-3" data-aos="fade-right">
        {{-- Gambar Utama --}}
        <img id="preview-main" src="{{ Storage::url($allImages[0]['path']) }}" alt="{{ $allImages[0]['alt'] }}" loading="eager" class="w-full lg:h-120 md:h-130 sm:h-117 object-cover object-top rounded-3xl transition-opacity duration-300">

        {{-- Thumbnail --}}
        <div class="lg:grid lg:grid-cols-5 flex sm:flex-col lg:mt-3 mt-1 gap-3 mb-1" role="group" aria-label="Pilih foto produk">
            @foreach ($allImages as $i => $img)
                <button type="button" class="preview-thumb rounded-xl overflow-hidden cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-var10 transition-opacity duration-200 {{ $i === 0 ? 'opacity-100 ring-2 ring-var10' : 'opacity-50 hover:opacity-80' }}" aria-label="Foto produk {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}" data-src="{{ Storage::url($img['path']) }}" data-alt="{{ $img['alt'] }}">
                    <img src="{{ Storage::url($img['path']) }}" alt="" loading="lazy" class="lg:w-full xl:h-20 lg:h-18 md:h-23.25 md:w-28 sm:h-20.75 sm:w-28 xs:h-20 h-15 object-cover object-top pointer-events-none">
                </button>
            @endforeach
        </div>
    </div>

    {{-- ====== Right: Info Produk ====== --}}
    <div class="xl:text-lg lg:text-base md:text-lg" data-aos="fade-left">
        <h1 id="detail-heading" class="xl:text-5xl md:text-4xl sm:text-3xl text-2xl lg:mb-3 md:mb-2 mb-1">{{ $product->name }}</h1>
        <p class="xl:text-3xl md:text-3xl sm:text-2xl text-xl text-var10 font-semibold">Mulai dari {{ $product->harga_mulai }}</p>

        {{-- Tab Filter --}}
        <div class="flex items-center gap-3 xl:mt-9 md:mt-8 mt-6 mb-6 overflow-x-auto scrollbar-none" role="tablist" aria-label="Informasi produk">
            @php
                $tabs = [
                    ['id' => 'tab-detail',  'label' => 'Detail Produk'],
                    ['id' => 'tab-harga',   'label' => 'Detail Harga'],
                    ['id' => 'tab-ukuran',  'label' => 'Ukuran & Warna'],
                ];
            @endphp
            @foreach ($tabs as $i => $tab)
                <button type="button" role="tab" id="{{ $tab['id'] }}-btn" class="tab-btn shrink-0 px-6 xl:py-1.75 md:py-2 py-2 rounded-full cursor-pointer transition-all duration-300 border font-medium {{ $i === 0 ? 'bg-var10 border-var10 text-var1' : 'bg-var1 border-var6 hover:bg-var10 hover:text-var1 hover:border-var10' }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="{{ $tab['id'] }}-panel">
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>

        {{-- ── Panel: Detail Produk ── --}}
        <div id="tab-detail-panel" role="tabpanel" aria-labelledby="tab-detail-btn">
            @if ($product->detail_deskripsi)
                <p>{{ $product->detail_deskripsi }}</p>
            @endif
            @if ($product->features->count() > 0)
                <ul class="list-disc ml-11 mt-3 space-y-1">
                    @foreach ($product->features as $fitur)
                        <li>{{ $fitur->fitur }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- ── Panel: Detail Harga ── --}}
        <div id="tab-harga-panel" role="tabpanel" aria-labelledby="tab-harga-btn" hidden>
            @if ($product->priceTiers->count() > 0)
                <div class="overflow-hidden rounded-xl border border-var6 mb-5">
                    <table class="w-full text-center table-fixed" aria-label="Tabel harga {{ $product->name }}">
                        <thead class="bg-var9 text-var1">
                            <tr class="divide-x divide-var6">
                                <th class="py-2.5 w-1/2" scope="col">KUANTITAS</th>
                                <th class="py-2.5 w-1/2" scope="col">HARGA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-var6">
                            @foreach ($product->priceTiers as $row)
                                <tr class="divide-x divide-var6">
                                    <td class="py-2.5">{{ $row->kualitas }}</td>
                                    <td class="py-2.5">{{ $row->harga }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if ($product->priceNotes->count() > 0)
                <p class="font-semibold mb-1">Catatan:</p>
                <ul class="list-disc ml-11 space-y-1">
                    @foreach ($product->priceNotes as $note)
                        <li>{{ $note->catatan }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- ── Panel: Ukuran & Warna ── --}}
        <div id="tab-ukuran-panel" role="tabpanel" aria-labelledby="tab-ukuran-btn" hidden>
            {{-- Tabel Ukuran --}}
            @if ($product->sizeHeader && $product->sizeRows->count() > 0)
                @php
                    $labelMap   = ['P' => 'P', 'L' => 'L', 'PL' => 'PL'];
                    $headerCols = $product->sizeHeader->headers;
                    $colCount   = count($headerCols);
                    $dataCols   = $colCount - 1;
                    $colWidth   = $dataCols > 0 ? round(65 / $dataCols, 2) : 65;
                @endphp
                <div class="overflow-hidden rounded-xl border border-var6">
                    <table class="w-full text-center table-fixed" aria-label="Tabel ukuran {{ $product->name }}">
                        <colgroup>
                            <col style="width: 11%">
                            @for ($c = 1; $c < $colCount; $c++)
                                <col style="width: {{ $colWidth }}%">
                            @endfor
                        </colgroup>
                        <thead class="bg-var9 text-var1">
                            <tr>
                                @foreach ($headerCols as $i => $h)
                                    <th class="py-2.5 px-3 text-center font-semibold {{ $i === 0 ? 'rounded-tl-xl' : '' }} {{ $i === $colCount - 1 ? 'rounded-tr-xl' : '' }} {{ $i < $colCount - 1 ? 'border-r border-var8' : '' }}" scope="col">{{ $h }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->sizeRows as $row)
                                @php
                                    $isLast     = $loop->last;
                                    $nilaiArr   = $row->nilai;
                                    $nilaiCount = count($nilaiArr);
                                @endphp
                                <tr class="border-t border-var6">
                                    <th class="py-2.5 px-3 text-center font-semibold bg-var9 text-var1 border-r border-var8 {{ $isLast ? 'rounded-bl-xl' : '' }}" scope="row">
                                        {{ $labelMap[$row->label] ?? $row->label }}
                                    </th>
                                    @foreach ($nilaiArr as $i => $val)
                                        <td class="py-2.5 px-3 text-center {{ $i < $nilaiCount - 1 ? 'border-r border-var6' : '' }} {{ $isLast && $i === $nilaiCount - 1 && $nilaiCount === $dataCols ? 'rounded-br-xl' : '' }}">
                                            {{ $val }}
                                        </td>
                                    @endforeach
                                    @for ($fill = $nilaiCount; $fill < $dataCols; $fill++)
                                        <td class="py-2.5 px-3 text-center border-r border-var6 text-var5">–</td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($product->ukuran_toleransi)
                    <p class="font-semibold my-5">{{ $product->ukuran_toleransi }}</p>
                @endif
            @endif

            {{-- Pilihan Warna --}}
            @if ($product->colors->count() > 0)
                <div class="border border-var6 rounded-xl p-4 {{ $product->sizeHeader ? 'mt-5' : '' }} text-center">
                    <p class="xl:text-xl lg:text-lg md:text-xl text-lg font-semibold">{{ $product->colors->count() }} Pilihan Warna</p>
                    <ul class="xl:text-base lg:text-sm md:text-base text-sm mt-5 grid lg:grid-cols-6 md:grid-cols-7 sm:grid-cols-5 grid-cols-4 gap-1" role="list" aria-label="Pilihan warna produk">
                        @foreach ($product->colors as $warna)
                            <li class="flex flex-col items-center space-y-1.5">
                                <div class="{{ $warna->has_border ? 'border border-var5' : '' }} rounded-full w-11 h-11" style="background-color: {{ $warna->hex }};" role="img" aria-label="Warna {{ $warna->nama }}"></div>
                                <p>{{ $warna->nama }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

        {{-- Tombol Order --}}
        <a href="{{ $product->wa_link }}" data-wa-source="product" data-wa-slug="{{ $product->slug }}" target="_blank" rel="noopener noreferrer" class="rotate-hover flex items-center justify-center py-3 mt-9 xl:text-xl lg:text-lg md:text-xl text-lg font-semibold gap-3 w-full text-var1 bg-var10 hover:bg-var11 transition-all duration-300 rounded-full cursor-pointer" aria-label="Pesan {{ $product->name }} via WhatsApp">
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.0781 2.90756C16.1572 1.98193 15.0604 1.24812 13.8516 0.748934C12.6428 0.249746 11.3463 -0.00482601 10.0377 6.92811e-05C4.55424 6.92811e-05 0.0853842 4.44755 0.0803616 9.90754C0.0803616 11.6563 0.53993 13.3575 1.40758 14.8638L0 20L5.27875 18.6225C6.73843 19.4153 8.37488 19.8301 10.0377 19.8288H10.0427C15.5274 19.8288 19.995 15.3813 20 9.91629C20.0011 8.61386 19.7434 7.32409 19.2417 6.12123C18.74 4.91836 18.0056 3.82618 17.0781 2.90756ZM10.0377 18.1513C8.55496 18.1501 7.09973 17.753 5.82371 17.0013L5.52235 16.8213L2.39076 17.6388L3.22702 14.5975L3.03114 14.2838C2.20217 12.9717 1.76375 11.4526 1.7667 9.90254C1.7667 5.37005 5.47966 1.67256 10.0427 1.67256C11.1298 1.67062 12.2065 1.88291 13.2107 2.29718C14.215 2.71145 15.1269 3.31951 15.894 4.08631C16.6636 4.85024 17.2737 5.75823 17.6892 6.75795C18.1047 7.75768 18.3174 8.82938 18.3149 9.91128C18.3099 14.46 14.5969 18.1513 10.0377 18.1513ZM14.5768 11.9838C14.3295 11.86 13.1077 11.2613 12.8779 11.1763C12.6494 11.095 12.4824 11.0525 12.3192 11.3C12.1522 11.5463 11.675 12.1075 11.5319 12.2688C11.3887 12.435 11.2406 12.4538 10.992 12.3313C10.7446 12.2063 9.94224 11.9463 8.99297 11.1C8.25213 10.4438 7.75615 9.63129 7.60798 9.38504C7.46484 9.13754 7.59417 9.00504 7.71848 8.88129C7.82772 8.77129 7.96584 8.59129 8.09015 8.44879C8.21572 8.30629 8.25716 8.20129 8.33877 8.03629C8.42039 7.86879 8.38146 7.72629 8.31994 7.60254C8.25716 7.47879 7.76117 6.25755 7.55148 5.76505C7.35058 5.2788 7.1459 5.3463 6.99272 5.34005C6.84957 5.3313 6.68257 5.3313 6.51557 5.3313C6.38947 5.3345 6.26539 5.36357 6.15109 5.41669C6.0368 5.46982 5.93475 5.54586 5.85133 5.64005C5.6228 5.88755 4.98368 6.4863 4.98368 7.70754C4.98368 8.92879 5.87519 10.1025 6.00075 10.2688C6.12381 10.435 7.75113 12.9338 10.2486 14.0088C10.8388 14.265 11.3034 14.4163 11.6662 14.5313C12.2627 14.7213 12.8014 14.6925 13.2308 14.6313C13.7079 14.5588 14.7012 14.0313 14.9108 13.4525C15.1168 12.8725 15.1168 12.3775 15.054 12.2738C14.9925 12.1688 14.8255 12.1075 14.5768 11.9838Z" fill="white"/></svg>
            Pesan Sekarang
        </a>
    </div>
</section>

@endsection

@push('scripts')
    @vite(['resources/js/public/modules/product.js'])
@endpush