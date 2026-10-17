<div id="modal-edit" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true" aria-labelledby="modal-edit-title">
    <div class="admin-modal max-w-2xl w-full">
        <div class="admin-modal-header">
            <h3 id="modal-edit-title" class="font-semibold text-xl -mb-1.5">Edit Akun</h3>
            <button type="button" onclick="closeModal('modal-edit')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <form id="form-edit" class="admin-modal-body space-y-4 mb-1.5">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-user-id">
            <div>
                <label class="admin-label">Nama <span class="text-var10">*</span></label>
                <input type="text" name="name" id="edit-name" class="admin-input" placeholder="Nama lengkap">
                <p class="admin-error-text hidden" data-error="name"></p>
            </div>
            <div>
                <label class="admin-label">Email <span class="text-var10">*</span></label>
                <input type="email" name="email" id="edit-email" class="admin-input" placeholder="email@kaosintim.id">
                <p class="admin-error-text hidden" data-error="email"></p>
            </div>
            <div>
                <label class="admin-label">Password Baru <span class="text-var7 font-normal">(opsional)</span></label>
                <input type="password" name="password" id="edit-password" class="admin-input" placeholder="Kosongkan jika tidak ingin mengubah">
                <p class="admin-error-text hidden" data-error="password"></p>
            </div>
            <div>
                <label class="admin-label">Role <span class="text-var10">*</span></label>
                <select name="role" id="edit-role" class="admin-input cursor-pointer">
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>
            <div>
                <label class="admin-label">Status</label>
                <label class="flex items-center gap-2.5 cursor-pointer mt-1">
                    <input type="checkbox" name="is_active" id="edit-is-active" class="w-4 h-4 accent-var10">
                    <span>Akun aktif</span>
                </label>
            </div>
        </form>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-edit')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitEdit()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>