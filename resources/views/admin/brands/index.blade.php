@extends('admin.layouts.app')

@section('title', 'Manage Brand Colab')
@section('page-title', 'Manage Brand Colab')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden">
    {{-- =========== Header =========== --}}
    <div class="flex items-center justify-between p-5 border-b border-var4">
        <div>
            <h2 class="text-xl font-semibold">Daftar Brand Kolaborasi</h2>
            <p class="text-var8">{{ $brands->count() }} brand kolaborasi terdaftar</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-1.5 ps-4 pe-5 py-2.5 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
            <i data-lucide="plus" class="w-4.5 h-4.5"></i> Tambah Brand Colab
        </button>
    </div> {{-- =========== End Header =========== --}}

    {{-- =========== Tabel =========== --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Alt Text</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brands as $item)
                    <tr>
                        <td>
                            <div class="w-20 h-10 bg-var3 rounded-lg flex items-center justify-center p-2">
                                <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->alt }}" class="max-h-full max-w-full object-contain">
                            </div>
                        </td>
                        <td>{{ $item->alt }}</td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->alt) }}', '{{ Storage::url($item->image_path) }}')" class="btn-icon bg-var3 hover:bg-var4 text-var8" title="Edit">
                                    <i data-lucide="pencil" class="w-4.5 h-4.5"></i>
                                </button>
                                <button type="button" onclick="deleteItem({{ $item->id }})" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-10 text-var7">Belum ada brand kolaborasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> {{-- =========== End Tabel =========== --}}
</section>

@include('admin.brands.modal-create')
@include('admin.brands.modal-edit')

@endsection

@push('scripts')
<script>
    const ROUTES = {
        store:   '{{ route('admin.brands.store') }}',
        update:  (id) => `/admin/brands/${id}`,
        destroy: (id) => `/admin/brands/${id}`,
    };
    const CSRF = '{{ csrf_token() }}';

    function openModal(id)  { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

    function showToast(message, type = 'success') {
        const existing = document.getElementById('toast-js');
        if (existing) existing.remove();
        const colors = { success: 'bg-green-50 border-green-200 text-green-800', error: 'bg-red-50 border-red-200 text-red-800' };
        const el = document.createElement('div');
        el.id = 'toast-js';
        el.className = `fixed top-5 right-5 z-[200] flex items-center gap-3 px-4 py-3 rounded-xl border shadow-md text-sm font-medium max-w-sm ${colors[type]}`;
        el.innerHTML = `<span>${message}</span><button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 cursor-pointer">✕</button>`;
        document.body.appendChild(el);
        setTimeout(() => { el.style.transition = 'opacity 0.4s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 400); }, 4000);
    }

    function openCreateModal() {
        document.getElementById('c-images').value = '';
        document.getElementById('c-previews').innerHTML = '';
        openModal('modal-create');
    }

    /* Preview multi logo */
    document.getElementById('c-images')?.addEventListener('change', (e) => {
        const container = document.getElementById('c-previews');
        container.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const url = URL.createObjectURL(file);
            const div = document.createElement('div');
            div.className = 'w-20 h-12 bg-var3 rounded-lg flex items-center justify-center p-2 border border-var4';
            div.innerHTML = `<img src="${url}" alt="${file.name}" class="max-h-full max-w-full object-contain">`;
            container.appendChild(div);
        });
    });

    async function submitCreate() {
        const files = document.getElementById('c-images').files;
        if (!files.length) { showToast('Pilih minimal 1 file logo.', 'error'); return; }

        const data = new FormData();
        Array.from(files).forEach(file => data.append('images[]', file));

        const res  = await fetch(ROUTES.store, { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: data });
        const json = await res.json();
        if (!res.ok) { showToast(json.message ?? 'Terjadi kesalahan.', 'error'); return; }
        closeModal('modal-create');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    function openEditModal(id, alt, imgUrl) {
        document.getElementById('e-id').value          = id;
        document.getElementById('e-alt').value         = alt;
        document.getElementById('e-current-img').src   = imgUrl;
        document.getElementById('e-image').value       = '';
        openModal('modal-edit');
    }

    async function submitEdit() {
        const id   = document.getElementById('e-id').value;
        const data = new FormData();
        data.append('_method', 'POST');
        data.append('alt', document.getElementById('e-alt').value);
        const file = document.getElementById('e-image').files[0];
        if (file) data.append('image', file);

        const res  = await fetch(ROUTES.update(id), { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: data });
        const json = await res.json();
        if (!res.ok) { showToast(json.message ?? 'Terjadi kesalahan.', 'error'); return; }
        closeModal('modal-edit');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    async function deleteItem(id) {
        if (!confirm('Hapus brand ini?')) return;
        const res  = await fetch(ROUTES.destroy(id), { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: new URLSearchParams({ _method: 'DELETE' }) });
        const json = await res.json();
        showToast(json.message, json.success ? 'success' : 'error');
        if (json.success) setTimeout(() => location.reload(), 800);
    }

    ['modal-create', 'modal-edit'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', function(e) { if (e.target === this) closeModal(id); });
    });
</script>
@endpush