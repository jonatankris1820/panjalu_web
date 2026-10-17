@extends('admin.layouts.app')

@section('title', 'Manage FAQ')
@section('page-title', 'Manage FAQ')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden">
    {{-- =========== Header =========== --}}
    <div class="flex items-center justify-between p-5 border-b border-var4">
        <div>
            <h2 class="text-xl font-semibold">Daftar FAQ</h2>
            <p class="text-var8">{{ $faqs->count() }} pertanyaan terdaftar</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-1.5 ps-4 pe-5 py-2.5 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
            <i data-lucide="plus" class="w-4.5 h-4.5"></i> Tambah FAQ
        </button>
    </div> {{-- =========== End Header =========== --}}

    {{-- =========== Tabel =========== --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faqs as $item)
                    <tr>
                        <td class="font-medium max-w-xs">{{ $item->pertanyaan }}</td>
                        <td class="max-w-sm truncate">{{ $item->jawaban }}</td>
                        <td class="text-center">
                            @if ($item->is_active)
                                <span class="badge-active"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Aktif</span>
                            @else
                                <span class="badge-inactive"><span class="w-1.5 h-1.5 rounded-full bg-var7"></span>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="openEditModal({{ $item->id }}, {{ json_encode($item->pertanyaan) }}, {{ json_encode($item->jawaban) }}, {{ $item->is_active ? 'true' : 'false' }})" class="btn-icon bg-var3 hover:bg-var4 text-var8" title="Edit">
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
                        <td colspan="4" class="text-center py-10 text-var7">Belum ada FAQ.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> {{-- =========== End Tabel =========== --}}
</section>

@include('admin.faqs.modal-create')
@include('admin.faqs.modal-edit')

@endsection

@push('scripts')
<script>
    const ROUTES = {
        store:   '{{ route('admin.faqs.store') }}',
        update:  (id) => `/admin/faqs/${id}`,
        destroy: (id) => `/admin/faqs/${id}`,
    };
    const CSRF = '{{ csrf_token() }}';

    function openModal(id)  { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.querySelectorAll(`#${id} [data-error]`).forEach(el => { el.textContent = ''; el.classList.add('hidden'); });
    }

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
        document.getElementById('c-pertanyaan').value  = '';
        document.getElementById('c-jawaban').value     = '';
        document.getElementById('c-is-active').checked = true;
        openModal('modal-create');
    }

    function openEditModal(id, pertanyaan, jawaban, isActive) {
        document.getElementById('e-id').value          = id;
        document.getElementById('e-pertanyaan').value  = pertanyaan;
        document.getElementById('e-jawaban').value     = jawaban;
        document.getElementById('e-is-active').checked = isActive;
        openModal('modal-edit');
    }

    async function submitCreate() {
        document.querySelectorAll('#modal-create [data-error]').forEach(el => { el.textContent = ''; el.classList.add('hidden'); });
        const data = new FormData();
        data.append('pertanyaan', document.getElementById('c-pertanyaan').value);
        data.append('jawaban',    document.getElementById('c-jawaban').value);
        data.append('is_active',  document.getElementById('c-is-active').checked ? '1' : '0');

        const res  = await fetch(ROUTES.store, { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: data });
        const json = await res.json();
        if (!res.ok) {
            if (json.errors) Object.entries(json.errors).forEach(([field, messages]) => {
                const el = document.querySelector(`#modal-create [data-error="${field}"]`);
                if (el) { el.textContent = messages[0]; el.classList.remove('hidden'); }
            });
            showToast(json.message ?? 'Terjadi kesalahan.', 'error');
            return;
        }
        closeModal('modal-create');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    async function submitEdit() {
        const id   = document.getElementById('e-id').value;
        const data = new FormData();
        data.append('_method',    'POST');
        data.append('pertanyaan', document.getElementById('e-pertanyaan').value);
        data.append('jawaban',    document.getElementById('e-jawaban').value);
        data.append('is_active',  document.getElementById('e-is-active').checked ? '1' : '0');

        const res  = await fetch(ROUTES.update(id), { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: data });
        const json = await res.json();
        if (!res.ok) { showToast(json.message ?? 'Terjadi kesalahan.', 'error'); return; }
        closeModal('modal-edit');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    async function deleteItem(id) {
        if (!confirm('Hapus FAQ ini?')) return;
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