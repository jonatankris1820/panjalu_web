<div id="modal-create" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true" aria-labelledby="modal-create-title">
    <div class="admin-modal max-w-2xl w-full">
        <div class="admin-modal-header">
            <h3 id="modal-create-title" class="font-semibold text-xl -mb-1.5">Tambah Akun</h3>
            <button type="button" onclick="closeModal('modal-create')" class="btn-icon hover:bg-var3 text-var8">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        
        <form id="form-create" class="admin-modal-body space-y-4 mb-1.5">
            @csrf
            <div>
                <label class="admin-label">Nama <span class="text-var10">*</span></label>
                <input type="text" name="name" class="admin-input" placeholder="Masukkan nama lengkap">
                <p class="admin-error-text hidden" data-error="name"></p>
            </div>
            <div>
                <label class="admin-label">Email <span class="text-var10">*</span></label>
                <input type="email" name="email" class="admin-input" placeholder="mis. contoh@mail.com">
                <p class="admin-error-text hidden" data-error="email"></p>
            </div>
            <div>
                <label class="admin-label">Password <span class="text-var10">*</span></label>
                <input type="password" name="password" class="admin-input" placeholder="Password minimal 6 karakter">
                <p class="admin-error-text hidden" data-error="password"></p>
            </div>
            <div>
                <label class="admin-label">Role <span class="text-var10">*</span></label>
                <select name="role" class="admin-input cursor-pointer">
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                </select>
                <p class="admin-error-text hidden" data-error="role"></p>
            </div>
        </form>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-create')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitCreate()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>