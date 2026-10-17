<div id="modal-edit" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-lg w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Edit Portofolio</h3>
            <button type="button" onclick="closeModal('modal-edit')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-4">
            <input type="hidden" id="e-id">
            <div>
                <label class="admin-label">Kategori <span class="text-var10">*</span></label>
                <select id="e-kategori" class="admin-input">
                    <option value="Corporate">Corporate</option>
                    <option value="UMKM">UMKM</option>
                    <option value="Event">Event</option>
                </select>
            </div>

            <div>
                <label class="admin-label">Gambar <span class="text-var7 font-normal text-sm">(klik untuk ganti)</span></label>
                <input type="file" id="e-image" accept="image/*" class="sr-only">
                <div id="e-dropzone" onclick="document.getElementById('e-image').click()" class="relative border-2 border-dashed border-var5 hover:border-var10 rounded-xl transition-colors duration-200 cursor-pointer overflow-hidden" style="min-height: 300px;">
                    <div id="e-dz-preview" class="absolute inset-0">
                        <img id="e-preview-img" src="" alt="" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-var9/50 opacity-0 hover:opacity-100 transition-opacity duration-200 flex flex-col items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-var1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-var1 text-sm font-semibold">Ganti Gambar</p>
                        </div>
                        <div id="e-dz-filename" class="hidden absolute bottom-0 left-0 right-0 bg-var9/70 text-var1 text-xs px-3 py-1.5 truncate"></div>
                    </div>

                    <div id="e-dz-placeholder" class="hidden flex-custom flex-col gap-2 py-8 px-4 text-center">
                        <div class="w-12 h-12 rounded-full bg-var3 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-var7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-var9">Klik atau drag & drop gambar</p>
                            <p class="text-xs text-var7 mt-0.5">PNG, JPG, WEBP — Maks. 2MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-edit')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitEdit()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>