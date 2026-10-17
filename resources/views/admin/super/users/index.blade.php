@extends('admin.layouts.app')

@section('title', 'Kelola Akun')
@section('page-title', 'Kelola Akun')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden">
    {{-- =========== Header =========== --}}
    <div class="flex items-center justify-between p-5 border-b border-var4">
        <div>
            <h2 class="text-xl font-semibold">Daftar Akun</h2>
            <p class="text-var8">{{ $users->count() }} akun terdaftar</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-1.5 ps-4 pe-5 py-2.5 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
            <i data-lucide="plus" class="w-4.5 h-4.5"></i>Tambah Akun
        </button>
    </div> {{-- =========== End Header =========== --}}

    {{-- =========== Table =========== --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-var10 text-var1 flex items-center justify-center text-xs font-semibold shrink-0">
                                    {{ $user->initials }}
                                </div>
                                <div>
                                    <p class="font-medium">{{ $user->name }}</p>
                                    @if ($user->id === auth()->id())
                                        <p class="text-xs text-var8">(Anda)</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role === 'super_admin')
                                <span class="badge-role-super">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Super Admin
                                </span>
                            @else
                                <span class="badge-role-admin">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Admin
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($user->is_active)
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
                                <button type="button" onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->role }}', {{ $user->is_active ? 'true' : 'false' }})" class="btn-icon bg-var3 hover:bg-var4 text-var8" title="Edit akun">
                                    <i data-lucide="pencil" class="w-4.5 h-4.5"></i>
                                </button>

                                @if ($user->id !== auth()->id())
                                    <button type="button" onclick="resetPassword({{ $user->id }}, '{{ addslashes($user->name) }}')" class="btn-icon bg-amber-50 hover:bg-amber-100 text-amber-600" title="Reset password ke Admin123">
                                        <i data-lucide="key-round" class="w-4.5 h-4.5"></i>
                                    </button>
                                    <button type="button" onclick="deleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500" title="Hapus akun">
                                        <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-var7">Belum ada akun.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> {{-- =========== End Table =========== --}}
</section>

@include('admin.super.users.modal-create')
@include('admin.super.users.modal-edit')

@endsection

@push('scripts')
<script>
    const ROUTES = {
        store:        '{{ route('admin.super.users.store') }}',
        update:       (id) => `/admin/super/users/${id}`,
        destroy:      (id) => `/admin/super/users/${id}`,
        resetPassword:(id) => `/admin/super/users/${id}/reset-password`,
    };
    const CSRF = '{{ csrf_token() }}';

    /* ── Modal Helpers ── */
    function openModal(id)  { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        clearErrors(id);
    }

    function clearErrors(modalId) {
        document.querySelectorAll(`#${modalId} [data-error]`).forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
        document.querySelectorAll(`#${modalId} .admin-input`).forEach(el => {
            el.classList.remove('admin-input-error');
        });
    }

    function showErrors(modalId, errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            const errEl  = document.querySelector(`#${modalId} [data-error="${field}"]`);
            const inputEl = document.querySelector(`#${modalId} [name="${field}"]`);
            if (errEl) {
                errEl.textContent = Array.isArray(messages) ? messages[0] : messages;
                errEl.classList.remove('hidden');
            }
            if (inputEl) inputEl.classList.add('admin-input-error');
        });
    }

    /* ── Toast ── */
    function showToast(message, type = 'success') {
        const existing = document.getElementById('toast-js');
        if (existing) existing.remove();

        const colors = {
            success: 'bg-green-50 border-green-200 text-green-800',
            error:   'bg-red-50 border-red-200 text-red-800',
        };
        const icons = { success: 'circle-check', error: 'circle-x' };

        const el = document.createElement('div');
        el.id = 'toast-js';
        el.className = `fixed top-5 right-5 z-[100] flex items-center gap-3 px-4 py-3 rounded-xl border shadow-md text-sm font-medium max-w-sm ${colors[type]}`;
        el.innerHTML = `<span>${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 cursor-pointer">✕</button>`;
        document.body.appendChild(el);

        setTimeout(() => {
            el.style.transition = 'opacity 0.4s ease';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        }, 4000);
    }

    /* ── Create ── */
    function openCreateModal() {
        document.getElementById('form-create').reset();
        openModal('modal-create');
    }

    async function submitCreate() {
        clearErrors('modal-create');
        const form = document.getElementById('form-create');
        const data = new FormData(form);

        const res  = await fetch(ROUTES.store, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: data,
        });
        const json = await res.json();

        if (!res.ok) {
            if (json.errors) showErrors('modal-create', json.errors);
            else showToast(json.message ?? 'Terjadi kesalahan.', 'error');
            return;
        }

        closeModal('modal-create');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    /* ── Edit ── */
    function openEditModal(id, name, email, role, isActive) {
        document.getElementById('edit-user-id').value  = id;
        document.getElementById('edit-name').value     = name;
        document.getElementById('edit-email').value    = email;
        document.getElementById('edit-role').value     = role;
        document.getElementById('edit-is-active').checked = isActive;
        document.getElementById('edit-password').value = '';
        openModal('modal-edit');
    }

    async function submitEdit() {
        clearErrors('modal-edit');
        const id   = document.getElementById('edit-user-id').value;
        const form = document.getElementById('form-edit');
        const data = new FormData(form);
        data.append('_method', 'PUT');
        data.append('is_active', document.getElementById('edit-is-active').checked ? '1' : '0');

        const res  = await fetch(ROUTES.update(id), {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: data,
        });
        const json = await res.json();

        if (!res.ok) {
            if (json.errors) showErrors('modal-edit', json.errors);
            else showToast(json.message ?? 'Terjadi kesalahan.', 'error');
            return;
        }

        closeModal('modal-edit');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    /* ── Reset Password ── */
    async function resetPassword(id, name) {
        if (!confirm(`Reset password ${name} ke "Admin123"?`)) return;

        const res  = await fetch(ROUTES.resetPassword(id), {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        });
        const json = await res.json();

        showToast(json.message, json.success ? 'success' : 'error');
    }

    /* ── Delete ── */
    async function deleteUser(id, name) {
        if (!confirm(`Hapus akun "${name}"? Tindakan ini tidak dapat dibatalkan.`)) return;

        const res  = await fetch(ROUTES.destroy(id), {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: new URLSearchParams({ _method: 'DELETE' }),
        });
        const json = await res.json();

        if (!res.ok) {
            showToast(json.message ?? 'Terjadi kesalahan.', 'error');
            return;
        }

        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    /* ── Tutup modal klik backdrop ── */
    ['modal-create', 'modal-edit'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', function(e) {
            if (e.target === this) closeModal(id);
        });
    });
</script>
@endpush