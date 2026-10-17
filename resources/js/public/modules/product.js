document.addEventListener('DOMContentLoaded', () => {

    /* 
    |──────────────────────────────────────────────────────────────────────────────────
    |   PREVIEW GAMBAR (product-detail)
    |──────────────────────────────────────────────────────────────────────────────────
    */
    const mainImg   = document.getElementById('preview-main');
    const thumbBtns = document.querySelectorAll('.preview-thumb');

    if (mainImg && thumbBtns.length) {
        thumbBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update gambar utama dengan fade
                mainImg.style.opacity = '0';
                setTimeout(() => {
                    mainImg.src = btn.dataset.src;
                    mainImg.alt = btn.dataset.alt;
                    mainImg.style.opacity = '1';
                }, 200);

                // Update state thumbnail
                thumbBtns.forEach(b => {
                    b.classList.remove('opacity-100', 'ring-2', 'ring-var10');
                    b.classList.add('opacity-50');
                    b.setAttribute('aria-pressed', 'false');
                });

                btn.classList.remove('opacity-50');
                btn.classList.add('opacity-100', 'ring-2', 'ring-var10');
                btn.setAttribute('aria-pressed', 'true');
            });
        });
    }

    /* 
    |──────────────────────────────────────────────────────────────────────────────────
    |   TAB FILTER (product-detail)
    |──────────────────────────────────────────────────────────────────────────────────
    */
    const tabBtns   = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('[role="tabpanel"]');

    if (tabBtns.length) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('aria-controls');

                // Update tombol
                tabBtns.forEach(b => {
                    const isActive = b === btn;
                    b.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    b.classList.toggle('bg-var10',     isActive);
                    b.classList.toggle('border-var10', isActive);
                    b.classList.toggle('text-var1',    isActive);
                    b.classList.toggle('bg-var1',      !isActive);
                    b.classList.toggle('border-var6',  !isActive);
                });

                // Update panel
                tabPanels.forEach(panel => {
                    if (panel.id === targetId) {
                        panel.removeAttribute('hidden');
                    } else {
                        panel.setAttribute('hidden', '');
                    }
                });
            });
        });
    }
});