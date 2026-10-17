<div id="modal-create" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-2xl w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Tambah FAQ</h3>
            <button type="button" onclick="closeModal('modal-create')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-3">
            <div>
                <label class="admin-label">Pertanyaan <span class="text-var10">*</span></label>
                <textarea id="c-pertanyaan" rows="3" class="admin-input resize-none" placeholder="Tulis pertanyaan..."></textarea>
                <p class="admin-error-text hidden" data-error="pertanyaan"></p>
            </div>
            <div>
                <label class="admin-label">Jawaban <span class="text-var10">*</span></label>
                <textarea id="c-jawaban" rows="5" class="admin-input resize-none" placeholder="Tulis jawaban..."></textarea>
                <p class="admin-error-text hidden" data-error="jawaban"></p>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" id="c-is-active" class="w-4 h-4 accent-var10" checked>
                <span class="text-sm font-medium">Aktif (tampil di website)</span>
            </label>
        </div>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-create')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitCreate()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>