document.addEventListener('DOMContentLoaded', () => {

    // ─── State ─────────────────────────────────────────────────────────────
    const BATCH = 12;
    let activeFilter = 'all';

    // ─── Elemen ────────────────────────────────────────────────────────────
    const allItems       = [...document.querySelectorAll('.portfolio-item')];
    const grid           = document.getElementById('portofolio-grid');
    const loadMoreBtn    = document.getElementById('load-more-btn');
    const filterBtns     = document.querySelectorAll('.filter-btn');
    const filterBar      = document.getElementById('filter-bar');
    const filterSentinel = document.getElementById('filter-sentinel');
    const gridSection    = document.getElementById('portofolio-grid-section');
    const lightbox       = document.getElementById('lightbox');
    const lightboxImg    = document.getElementById('lightbox-img');
    const lightboxClose  = document.getElementById('lightbox-close');

    // ─── Filter Logic ──────────────────────────────────────────────────────
    function getFiltered() {
        return activeFilter === 'all'
            ? allItems
            : allItems.filter(el => el.dataset.kategori === activeFilter);
    }

    function renderItems() {
        const filtered = getFiltered();

        // Sembunyikan semua dulu
        allItems.forEach(el => {
            el.style.display = 'none';
            el.removeAttribute('data-visible');
        });

        // Tampilkan batch pertama dari filtered
        filtered.slice(0, BATCH).forEach(el => {
            el.style.display = '';
            el.dataset.visible = '1';
        });

        // Load more: tampilkan jika filtered > BATCH
        const remaining = filtered.length - BATCH;
        if (remaining > 0) {
            loadMoreBtn.style.display = 'flex';
            loadMoreBtn.dataset.shown = BATCH;
            loadMoreBtn.dataset.total = filtered.length;
        } else {
            loadMoreBtn.style.display = 'none';
        }

        createIcons({ icons });
    }

    // ─── Load More ─────────────────────────────────────────────────────────
    loadMoreBtn.addEventListener('click', () => {
        const filtered  = getFiltered();
        const shown     = parseInt(loadMoreBtn.dataset.shown) || BATCH;
        const nextBatch = shown + BATCH;

        filtered.slice(shown, nextBatch).forEach(el => {
            el.style.display = '';
            el.dataset.visible = '1';
        });

        loadMoreBtn.dataset.shown = nextBatch;

        if (nextBatch >= filtered.length) {
            loadMoreBtn.style.display = 'none';
        }
    });

    // ─── Filter Buttons ────────────────────────────────────────────────────
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            activeFilter = btn.dataset.filter;

            // Update aria-pressed & style
            filterBtns.forEach(b => {
                const isActive = b === btn;
                b.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                b.classList.toggle('bg-var10',      isActive);
                b.classList.toggle('border-var10',  isActive);
                b.classList.toggle('text-var1',     isActive);
                b.classList.toggle('bg-var1',       !isActive);
                b.classList.toggle('border-var6',   !isActive);
            });

            renderItems();
        });
    });

    // ─── Sticky Filter ─────────────────────────────────────────────────────
    const navbar    = document.getElementById('navbar');
    const navHeight = () => navbar?.offsetHeight ?? 0;
    const wrapper   = document.getElementById('filter-sticky-wrapper');

    let isSticky = false;

    function setSticky(sticky) {
        if (sticky === isSticky) return;
        isSticky = sticky;

        if (sticky) {
            wrapper.style.height = filterBar.offsetHeight + 'px';

            // Reset animasi di child, bukan di filterBar langsung
            const aosChild = filterBar.querySelector('[data-aos]');
            if (aosChild) {
                aosChild.style.opacity  = '';
                aosChild.style.transform = '';
            }

            filterBar.classList.add('fixed', 'left-0', 'right-0', 'w-full');
            filterBar.style.top = `${navHeight()}px`;
        } else {
            wrapper.style.height = '';
            filterBar.classList.remove('fixed', 'left-0', 'right-0', 'w-full');
            filterBar.style.top = '';
        }
    }

    const stickyObserver = new IntersectionObserver(
        ([entry]) => {
            const isPast = !entry.isIntersecting && entry.boundingClientRect.top < navHeight();
            setSticky(isPast);
        },
        { threshold: 0, rootMargin: `-${navHeight()}px 0px 0px 0px` }
    );

    const stickyEndObserver = new IntersectionObserver(
        ([entry]) => {
            if (!entry.isIntersecting && entry.boundingClientRect.top < 0) {
                setSticky(false);
            }
        },
        { threshold: 0 }
    );

    if (filterSentinel) stickyObserver.observe(filterSentinel);
    if (gridSection)    stickyEndObserver.observe(gridSection);

    // ─── Lightbox ──────────────────────────────────────────────────────────
    function openLightbox(trigger) {
        const { gambar } = trigger.dataset;

        lightboxImg.src = gambar;
        lightboxImg.alt = 'Portofolio';

        lightbox.setAttribute('aria-hidden', 'false');
        lightbox.classList.remove('opacity-0', 'pointer-events-none');
        lightbox.classList.add('opacity-100');
        document.body.style.overflow = 'hidden';
        document.querySelector('#lightbox').focus();

        // Fokus ke tombol close untuk aksesibilitas
        lightboxClose.focus();
    }

    function closeLightbox() {
        lightbox.classList.remove('opacity-100');
        lightbox.classList.add('opacity-0', 'pointer-events-none');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        lightboxImg.src = '';
    }

    // Delegasi event ke grid supaya works setelah load more
    grid.addEventListener('click', (e) => {
        const trigger = e.target.closest('.portfolio-trigger');
        if (trigger) openLightbox(trigger);
    });

    lightboxClose.addEventListener('click', closeLightbox);

    // Tutup klik backdrop
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    // Tutup dengan Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !lightbox.classList.contains('pointer-events-none')) {
            closeLightbox();
        }
    });

    // ─── Init ──────────────────────────────────────────────────────────────
    renderItems();
});