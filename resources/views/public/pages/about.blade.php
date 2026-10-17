@extends('public.layouts.main')

@section('title', 'Tentang PT PANJALU | PT PANJALU')
@section('meta_description', 'Kenali lebih dekat PT Panjalu, pencapaian, visi, dan layanan yang kami sediakan.')
@section('meta_keywords', 'tentang pt panjalu, profil pt panjalu, sejarah pt panjalu, visi misi pt panjalu')

@section('canonical', route('about.index'))
@section('og_title', 'Tentang PT PANJALU | PT PANJALU')
@section('og_description', 'Kenali lebih dekat PT Panjalu dan nilai yang kami jaga.')
@section('og_url', route('about.index'))

@section('content')

{{-- =========== Section 1 - Tentang PT Panjalu =========== --}}
<section class="mt-26 mb-30 max-w-338 mx-auto xl:px-10 sm:px-8 px-5" aria-labelledby="owner-heading">
    <x-public.title title="TENTANG PT PANJALU" />

    <div class="grid lg:grid-cols-[1fr_2fr] md:gap-10 gap-8 mt-12">
        <img src="{{ asset('images/technician-transparent.png') }}" alt="Teknisi PT Panjalu memasang perangkat jaringan" loading="lazy" class="w-full max-w-[24rem] h-auto object-contain object-top rounded-3xl mx-auto" data-aos="fade-right">

        <div class="lg:text-lg lg:space-y-6 md:space-y-5 space-y-4 text-white" data-aos="fade-up">
            <h1 id="owner-heading" class="lg:text-5xl md:text-4xl text-3xl text-var10 lg:text-start text-center">PT Panjalu</h1>
            <p>Kami adalah perusahaan dalam bidang Internet Service Provider, yang berusaha untuk memberikan pelayanan terbaik dalam menghadapi era transformasi digital saat ini.</p>
            <p>Dalam jaringan koneksi kami menggunakan Media Fiber & Wirelles menyesuaikan medan & lokasi yang ada. Dengan layanan bandwith tanpa FUP agar menjadi kenyaman untuk setiap pelanggan.</p>
            <p>Seiring meningkatnya kebutuhan dalam bidang teknologi informasi, khususnya koneksi internet dalam beberapa tahun terakhir, Kami hadir untuk ikut serta dalam peran untuk memenuhi kebutuhan tersebut. Kami akan senantiasa berkomitmen untuk mengakomodasi setiap kebutuhan pelanggan. Memperbaiki setiap layanan yang ada sehingga setiap pelanggan personal maupun corporate mendapatkan kepuasan maksimal yang menjadi prioritas kami.</p>
        </div>
    </div>
</section> {{-- =========== End Section 1 - Tentang PT Panjalu =========== --}}

@endsection