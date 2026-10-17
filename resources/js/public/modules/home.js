document.addEventListener('DOMContentLoaded', () => {
    /* 
    |──────────────────────────────────────────────────────────────────────────────────
    |   Hero Image Carousel 
    |──────────────────────────────────────────────────────────────────────────────────
    */
    const carousel = document.getElementById('hero-carousel');

    if (carousel) {
        const slides = carousel.querySelectorAll('.hero-slide');
        const total  = slides.length;
        let current  = 0;
        let interval = null;

        if (total > 1) {
            const goTo = (index) => {
                const prev = current;
                current    = (index + total) % total;

                slides[prev].style.opacity  = '0';
                slides[prev].style.position = 'absolute';

                slides[current].style.opacity  = '1';
                slides[current].style.position = 'relative';
            };

            const startAutoplay = () => {
                interval = setInterval(() => goTo(current + 1), 4000);
            };

            const stopAutoplay = () => clearInterval(interval);

            carousel.addEventListener('mouseenter', stopAutoplay);
            carousel.addEventListener('mouseleave', startAutoplay);

            startAutoplay();
        }
    }

    /* 
    |──────────────────────────────────────────────────────────────────────────────────
    |   Testimoni Carousel 
    |──────────────────────────────────────────────────────────────────────────────────
    */
    const initCarousel = (carouselId, prevBtnId, nextBtnId) => {
        const carousel = document.getElementById(carouselId);
        if (!carousel) return;

        const pages   = carousel.querySelectorAll('.testimoni-page');
        const dots    = carousel.querySelectorAll('.testimoni-dot');
        const btnPrev = document.getElementById(prevBtnId);
        const btnNext = document.getElementById(nextBtnId);
        const total   = pages.length;
        let current   = 0;

        const goTo = (index) => {
            pages[current].style.opacity       = '0';
            pages[current].style.position      = 'absolute';
            pages[current].style.pointerEvents = 'none';
            pages[current].setAttribute('aria-hidden', 'true');
            dots[current].classList.replace('bg-var9', 'bg-var4');
            dots[current].setAttribute('aria-current', 'false');

            current = (index + total) % total;

            pages[current].style.opacity       = '1';
            pages[current].style.position      = 'relative';
            pages[current].style.pointerEvents = 'auto';
            pages[current].setAttribute('aria-hidden', 'false');
            dots[current].classList.replace('bg-var4', 'bg-var9');
            dots[current].setAttribute('aria-current', 'true');
        };

        btnPrev.addEventListener('click', () => goTo(current - 1));
        btnNext.addEventListener('click', () => goTo(current + 1));
        dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));
    };

    initCarousel('testimoni-carousel-lg', 'btn-prev-lg', 'btn-next-lg');
    initCarousel('testimoni-carousel-md', 'btn-prev-md', 'btn-next-md');
    initCarousel('testimoni-carousel-xs', 'btn-prev-xs', 'btn-next-xs');
});