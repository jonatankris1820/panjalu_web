@extends('admin.layouts.app')

@section('title', 'Manage Produk')
@section('page-title', 'Manage Produk')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden text-[15px]">
    {{-- =========== Header =========== --}}
    <div class="flex items-center justify-between p-5 border-b border-var4">
        <div>
            <h2 class="text-xl font-semibold">Daftar Produk</h2>
            <p class="text-var8">{{ $products->count() }} produk terdaftar</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-1.5 ps-4 pe-5 py-2.5 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
            <i data-lucide="plus" class="w-4.5 h-4.5"></i>
            Tambah Produk
        </button>
    </div> {{-- =========== End Header =========== --}}

    {{-- =========== Table =========== --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga Mulai</th>
                    <th>Spesifikasi</th>
                    <th class="text-center">Best Seller</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->cover_image ? Storage::url($product->cover_image) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="h-10 rounded-lg object-cover shrink-0">
                                <div>
                                    <p class="font-medium">{{ $product->name }}</p>
                                    <p class="text-[13px] text-var7">{{ $product->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->harga_mulai }}</td>
                        <td>{{ $product->spesifikasi ?? '–' }}</td>
                        <td class="text-center">
                            @if ($product->is_best_seller)
                                <span class="inline-flex items-center gap-1.25 px-4 py-0.75 text-[13px] font-semibold rounded-full bg-amber-100 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>Best Seller
                                </span>
                            @else
                                <span class="text-var6 text-sm">–</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($product->is_active)
                                <span class="badge-active">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Aktif
                                </span>
                            @else
                                <span class="badge-inactive">
                                    <span class="w-1.5 h-1.5 rounded-full bg-var7"></span>Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="openEditModal({{ $product->id }})" class="btn-icon bg-var3 hover:bg-var4 text-var8" title="Edit">
                                    <i data-lucide="pencil" class="w-4.5 h-4.5"></i>
                                </button>
                                <button type="button" onclick="deleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-var7">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> {{-- =========== End Table =========== --}}
</section>

@include('admin.products.modal-form')

@endsection

@push('scripts')
@vite(['resources/js/admin/modules/products.js'])
<script>
    const ROUTES = {
        store:   '{{ route('admin.products.store') }}',
        update:  (id) => `/admin/products/${id}`,
        destroy: (id) => `/admin/products/${id}`,
        edit:    (id) => `/admin/products/${id}`,
    };
    const CSRF = '{{ csrf_token() }}';
</script>
@endpush