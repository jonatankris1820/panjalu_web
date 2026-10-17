@extends('public.layouts.main')

@section('title', 'Kontak PT PANJALU | PT PANJALU')
@section('meta_description', 'Hubungi PT Panjalu untuk informasi layanan, dukungan, dan kontak resmi.')
@section('meta_keywords', 'kontak pt panjalu, hubungi pt panjalu, layanan pt panjalu')

@section('canonical', route('contact.index'))
@section('og_title', 'Kontak PT PANJALU | PT PANJALU')
@section('og_description', 'Hubungi kami untuk informasi layanan dan dukungan PT Panjalu.')
@section('og_url', route('contact.index'))

@section('content')

{{-- =========== Section 1 - Kontak & Form =========== --}}
<section class="mt-36 max-w-338 mx-auto xl:px-10 sm:px-8 px-5 overflow-hidden" aria-labelledby="kontak-heading">
    <div class="mb-8 xl:w-130 lg:w-95">
        <h1 id="kontak-heading" class="lg:text-5xl md:text-4xl text-3xl lg:w-90 lg:leading-12.5 lg:text-start text-center text-white" data-aos="fade-up">Siap <span class="text-var10">Bergabung?</span></h1>
        <p class="lg:text-lg lg:mt-4.5 mt-2 lg:text-start text-center text-white" data-aos="fade-up">Hubungi kami untuk informasi layanan, dukungan, atau kebutuhan terkait PT Panjalu.</p>
    </div>
    
    <div class="grid lg:grid-cols-[1.35fr_2fr] xl:gap-12 lg:gap-7 gap-15">
        {{-- ===== Kiri: Info Kontak ===== --}}
        <address class="not-italic lg:flex lg:flex-col grid md:grid-cols-2 gap-4 lg:order-1 order-2" data-aos="fade-right">
            @php
                $kontakItems = [
                    ['type' => 'link',  'icon' => 'phone',      'judul' => 'WhatsApp',         'teks'  => '0812-7391-9000',                                                         'href' => 'https://wa.me/6281273919000',                'target' => '_blank',  'label' => 'Hubungi via WhatsApp: 0812-7391-9000',       'data_wa_source' => 'contact'], 
                    ['type' => 'div',   'icon' => 'clock',      'judul' => 'Jam Operasional',  'teks'  => 'Senin-Jumat: 08.00-17.00<br>Sabtu: 08.00-12.00'],
                    ['type' => 'link',  'icon' => 'map-pin',    'judul' => 'Alamat',           'teks'  => 'Perum. Green Simpang Lima, Blok A-09, Area Sawah/Kebun, Wonojoyo, Kec. Gurah, Kabupaten Kediri, Jawa Timur 64181',  'href' => 'https://maps.app.goo.gl/nLeSCueCQz8uPauB8',  'target' => '_blank',  'label' => 'Lihat lokasi kami di Google Maps',  'span' => true, 'teks_class' => 'lg:max-w-75 sm:max-w-full max-w-75'],
                ];
            @endphp
            @foreach ($kontakItems as $item)
                @if ($item['type'] === 'link')
                    <a href="{{ $item['href'] }}" {{ $item['target'] === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '' }} class="rotate-hover group flex items-center gap-4 bg-var2 py-4 px-5 rounded-xl {{ ($item['span'] ?? false) ? 'md:col-span-2 lg:col-span-1' : '' }}" aria-label="{{ $item['label'] }}" @isset($item['data_wa_source']) data-wa-source="{{ $item['data_wa_source'] }}" @endisset>
                @else
                    <div class="rotate-hover group flex items-center gap-4 bg-var2 py-4 px-5 rounded-xl {{ ($item['span'] ?? false) ? 'md:col-span-2 lg:col-span-1' : '' }}">
                @endif
                    <div class="bg-var4 lg:w-13 w-12 lg:h-13 h-12 flex items-center justify-center rounded-xl group-hover:bg-var9 group-hover:text-var1 transition-all duration-300" aria-hidden="true">
                        <i data-lucide="{{ $item['icon'] }}" class="lg:w-8 w-7 lg:h-8 h-7"></i>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">{{ $item['judul'] }}</p>
                        <p class="{{ $item['teks_class'] ?? '' }}">{!! $item['teks'] !!}</p>
                    </div>
                @if ($item['type'] === 'link')
                    </a>
                @else
                    </div>
                @endif
            @endforeach
        </address>
        
        {{-- ===== Kanan: Form ===== --}}
        <div class="lg:order-2 order-1 bg-var2 rounded-2xl lg:px-8 md:px-7 px-6 md:pt-8 pt-7 pb-7" data-aos="fade-left">
            <h2 class="lg:text-2xl text-xl font-semibold mb-1.5">Kirim Pesan</h2>
            <p class="mb-7">Silahkan isi form di bawah dan kami akan menghubungi Anda secepatnya.</p>

            <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-4.5">
                @csrf
                {{-- Nama & WhatsApp --}}
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="block mb-1.75 font-semibold">Nama Lengkap <span class="text-var10" aria-hidden="true">*</span><span class="sr-only">(wajib diisi)</span></label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" value="{{ old('nama') }}" class="w-full border border-var5 rounded-lg px-4 py-3 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-300" autocomplete="name" aria-required="true">
                        <div role="alert" class="error-message text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div>
                        <label for="whatsapp" class="block mb-1.75 font-semibold">No. WhatsApp <span class="text-var10" aria-hidden="true">*</span><span class="sr-only">(wajib diisi)</span></label>
                        <input type="tel" id="whatsapp" name="whatsapp" placeholder="mis. +62" value="{{ old('whatsapp') }}" class="w-full border border-var5 rounded-lg px-4 py-3 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-300" autocomplete="tel" aria-required="true">
                        <div role="alert" class="error-message text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-1.75 font-semibold">Email <span class="text-var10" aria-hidden="true">*</span><span class="sr-only">(wajib diisi)</span></label>
                    <input type="email" id="email" name="email" placeholder="mis. contoh@mail.com" value="{{ old('email') }}" class="w-full border border-var5 rounded-lg px-4 py-3 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-300" autocomplete="email" aria-required="true">
                    <div role="alert" class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                {{-- Keperluan --}}
                <div>
                    <label class="block mb-1.75 font-semibold" id="keperluan-label-text">Keperluan <span class="text-var10" aria-hidden="true">*</span><span class="sr-only">(wajib diisi)</span></label>
                    @php
                        $keperluanOptions = [
                            'pemasaran' => 'Pemesanan',
                            'penawaran'     => 'Penawaran',
                            'kerjasama'    => 'Kerja sama',
                            'lainnya'   => 'Lainnya',
                        ];
                    @endphp
                    <input type="hidden" id="keperluan-value" name="keperluan" value="{{ old('keperluan') }}">

                    <div id="keperluan-dropdown" class="relative">
                        <button type="button" id="keperluan-trigger" class="w-full flex items-center justify-between border border-var5 rounded-lg px-4 py-3 bg-var1 transition-colors duration-300 cursor-pointer" aria-haspopup="listbox" aria-expanded="false" aria-labelledby="keperluan-label-text keperluan-trigger" aria-controls="keperluan-options">
                            <span id="keperluan-display" class="text-var6">Silakan pilih keperluan</span>
                            <i data-lucide="chevron-down" id="keperluan-icon" class="w-5 h-5 shrink-0 transition-transform duration-300" aria-hidden="true"></i>
                        </button>
                        <ul id="keperluan-options" role="listbox" aria-labelledby="keperluan-label-text" class="absolute z-20 w-full mt-1.5 bg-var1 border border-var5 rounded-xl overflow-hidden shadow-lg hidden">
                            @foreach ($keperluanOptions as $value => $label)
                                <li class="keperluan-option px-5 py-3 text-[15px] cursor-pointer hover:bg-var4 hover:text-var9 transition-colors duration-200" role="option" aria-selected="{{ old('keperluan') === $value ? 'true' : 'false' }}" data-value="{{ $value }}">
                                    {{ $label }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div role="alert" class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                {{-- Pesan --}}
                <div>
                    <label for="pesan" class="block mb-1.75 font-semibold">Pesan <span class="text-var10" aria-hidden="true">*</span><span class="sr-only">(wajib diisi)</span></label>
                    <textarea id="pesan" name="pesan" rows="7" placeholder="Ceritakan kebutuhan Anda...." class="w-full border border-var5 rounded-lg px-4 py-3 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-300 resize-none" aria-required="true">{{ old('pesan') }}</textarea>
                    <div role="alert" class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                {{-- Submit --}}
                <button type="submit" id="submitBtn" class="rotate-hover -mb-2 sm:text-lg w-full flex items-center justify-center gap-2 py-3 px-8 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-full transition-all duration-300 cursor-pointer">
                    <span id="btnText">Kirim Pesan Sekarang</span>
                    <i data-lucide="arrow-up-right" id="btnIcon" class="w-6 h-6 stroke-2" aria-hidden="true"></i>
                </button>

                <div id="notificationArea" class="hidden"></div>
            </form>
        </div>
    </div>
</section> {{-- =========== End Section 1 - Kontak & Form =========== --}}

{{-- =========== Section 2 - Google Maps =========== --}}
<section class="mt-30" aria-label="Lokasi kegiatan PT Panjalu" data-aos="fade-up">
    <iframe width="100%" class="lg:h-125 h-100" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi PT Panjalu di Google Maps" aria-label="Peta lokasi PT Panjalu" src="https://www.google.com/maps?q=-7.8174619,112.0802947&z=15&output=embed"></iframe>
</section> {{-- =========== End Section 2 - Google Maps =========== --}}

{{-- =========== Section 3 - FAQ =========== --}}
<section aria-labelledby="faq-heading" class="my-30">
    <x-public.title title="FAQ KLIEN" />

    <div class="max-w-338 mx-auto xl:px-10 sm:px-8 px-5 mt-9">
        <h2 id="faq-heading" data-aos="fade-up" class="lg:text-5xl md:text-4xl text-3xl md:leading-12.5 mb-2 text-center text-var1">Pertanyaan Yang <span class="text-var10">Sering Diajukan.</span></h2>

        @php $faqContact = \App\Models\Faq::where('is_active', true)->orderBy('sort_order')->get()->unique('sort_order')->take(3)->values(); @endphp
        <dl class="mt-8 space-y-5">
            @forelse ($faqContact as $i => $faq)
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
</section> {{-- =========== End Section 3 - FAQ =========== --}}

@endsection

@push('scripts')
@vite(['resources/js/public/modules/contact.js'])
@endpush