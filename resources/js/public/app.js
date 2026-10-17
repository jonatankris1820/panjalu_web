import '../bootstrap.js';

const initializePublicApp = () => {
    /* 
    |──────────────────────────────────────────────────────────────────────────────
    |   Navbar Scroll Effect
    |──────────────────────────────────────────────────────────────────────────────
    */
    const navbar = document.getElementById('navbar');

    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 30) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, { passive: true });
    }


    /* 
    |──────────────────────────────────────────────────────────────────────────────
    |   WhatsApp Float — Fade in/out saat scroll
    |──────────────────────────────────────────────────────────────────────────────
    */
    const whatsappFloat = document.getElementById('whatsapp-float');

    if (whatsappFloat) {
        whatsappFloat.style.opacity       = '0';
        whatsappFloat.style.pointerEvents = 'none';
        whatsappFloat.style.transition    = 'opacity 0.5s ease';

        window.addEventListener('scroll', () => {
            const show = window.scrollY > 200;
            whatsappFloat.style.opacity       = show ? '1' : '0';
            whatsappFloat.style.pointerEvents = show ? 'auto' : 'none';
        }, { passive: true });
    }


    /* 
    |──────────────────────────────────────────────────────────────────────────────
    |   Hamburger — Toggle Mobile Menu
    |──────────────────────────────────────────────────────────────────────────────
    */
    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const body       = document.body;

    function openMobileMenu() {
        hamburger.classList.add('active');
        mobileMenu.classList.add('active');
        navbar?.classList.add('no-shadow');
        body.style.overflow = 'hidden';
        hamburger.setAttribute('aria-expanded', 'true');
        mobileMenu.setAttribute('aria-hidden', 'false');
    }

    function closeMobileMenu() {
        hamburger.classList.remove('active');
        mobileMenu.classList.remove('active');
        navbar?.classList.remove('no-shadow');
        body.style.overflow = '';
        hamburger.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');
    }

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            const isActive = mobileMenu.classList.contains('active');
            isActive ? closeMobileMenu() : openMobileMenu();
        });

        /* Tutup saat klik di luar */
        document.addEventListener('click', (e) => {
            if (
                mobileMenu.classList.contains('active') &&
                !hamburger.contains(e.target) &&
                !mobileMenu.contains(e.target)
            ) {
                closeMobileMenu();
            }
        });

        /* Tutup saat tekan Escape */
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
                hamburger.focus();
            }
        });
    }


    /* 
    |──────────────────────────────────────────────────────────────────────────────
    |   Counter Animation
    |──────────────────────────────────────────────────────────────────────────────
    */
    const counters = document.querySelectorAll('[data-counter]');

    if (counters.length > 0) {
        const animateCounter = (el) => {
            const target = parseFloat(el.dataset.counter);
            const suffix = el.dataset.counterSuffix ?? '';

            if (Number.isNaN(target)) {
                return;
            }

            el.textContent = target + suffix;
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(el => observer.observe(el));
    }


    /* 
    |──────────────────────────────────────────────────────────────────────────────
    |   FAQ Accordion
    |──────────────────────────────────────────────────────────────────────────────
    */
    const faqBtns = document.querySelectorAll('.faq-btn');

    if (faqBtns.length > 0) {
        faqBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const isOpen = btn.getAttribute('aria-expanded') === 'true';

                faqBtns.forEach(otherBtn => {
                    const otherAnswer = document.getElementById(otherBtn.getAttribute('aria-controls'));
                    const otherIcon   = otherBtn.querySelector('.faq-icon');

                    otherBtn.setAttribute('aria-expanded', 'false');
                    otherIcon?.classList.remove('rotate-180');
                    if (otherAnswer) {
                        otherAnswer.style.maxHeight = '0';
                        otherAnswer.style.opacity   = '0';
                    }
                });

                if (!isOpen) {
                    const answer = document.getElementById(btn.getAttribute('aria-controls'));
                    const icon   = btn.querySelector('.faq-icon');

                    btn.setAttribute('aria-expanded', 'true');
                    icon?.classList.add('rotate-180');
                    if (answer) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.opacity   = '1';
                    }
                }
            });
        });
    }

    /* 
    |──────────────────────────────────────────────────────────────────────────────
    |   WhatsApp Click Tracking
    |──────────────────────────────────────────────────────────────────────────────
    */
    document.querySelectorAll('[data-wa-source]').forEach(el => {
        el.addEventListener('click', () => {
            const source = el.dataset.waSource;
            const slug   = el.dataset.waSlug ?? null;

            const payload = new FormData();
            payload.append('source', source);
            if (slug) payload.append('product_slug', slug);

            /* Fire and forget — tidak perlu tunggu response */
            navigator.sendBeacon
                ? navigator.sendBeacon(
                    '/wa-track',
                    new URLSearchParams({
                        source,
                        product_slug: slug ?? '',
                        _token: document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    })
                )
                : fetch('/wa-track', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ source, product_slug: slug ?? '' }),
                    keepalive: true,
                });
        });
    });

};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializePublicApp, { once: true });
} else {
    initializePublicApp();
}