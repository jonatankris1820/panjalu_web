<div id="modal-create" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-3xl w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Tambah Testimoni</h3>
            <button type="button" onclick="closeModal('modal-create')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-4">
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="admin-label">Nama Klien <span class="text-var10">*</span></label>
                    <input type="text" id="c-nama" class="admin-input" placeholder="mis. Ahmad Sharoni">
                    <p class="admin-error-text hidden" data-error="nama"></p>
                </div>
                <div>
                    <label class="admin-label">Perusahaan</label>
                    <input type="text" id="c-perusahaan" class="admin-input" placeholder="mis. PT. Contoh">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="admin-label">Foto Klien <span class="text-var7 font-normal text-sm">(opsional, maks 1MB)</span></label>
                    <input type="file" id="c-foto" accept="image/*" class="admin-input cursor-pointer">
                    <div id="c-foto-preview" class="mt-2 hidden">
                        <img id="c-foto-preview-img" src="" alt="" class="w-14 h-14 rounded-full object-cover border border-var4">
                    </div>
                </div>
                <div>
                    <label class="admin-label">Rating <span class="text-var10">*</span></label>
                    <div class="flex items-center gap-2 mt-1" id="c-star-container">
                        @for ($s = 1; $s <= 5; $s++)
                            <button type="button" data-value="{{ $s }}" class="star-btn text-var5 hover:text-amber-400 transition-colors cursor-pointer" onclick="setRating('c', {{ $s }})">
                                <i data-lucide="star" class="w-7 h-7"></i>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" id="c-rating" value="">
                    <p class="admin-error-text hidden" data-error="rating"></p>
                </div>
            </div>
            <div>
                <label class="admin-label">Deskripsi Testimoni <span class="text-var10">*</span></label>
                <textarea id="c-pesan" rows="5" class="admin-input resize-none" placeholder="Cerita testimoni klien..."></textarea>
                <p class="admin-error-text hidden" data-error="pesan"></p>
            </div>
            
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="c-is-active" class="w-4 h-4 accent-var10" checked>
                    <span class="text-sm font-medium">Aktif (tampil di website)</span>
                </label>
            </div>
        </div>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-create')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitCreate()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>