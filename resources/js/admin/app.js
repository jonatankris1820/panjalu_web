import '../bootstrap.js';
import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {

    /* ── Lucide Icons ── */
    createIcons({ icons });

    /* 
    |──────────────────────────────────────────────────────
    |   User Dropdown Topbar
    |──────────────────────────────────────────────────────
    */
    const dropdownBtn  = document.getElementById('user-dropdown-btn');
    const dropdownMenu = document.getElementById('user-dropdown-menu');
    const chevron      = document.getElementById('user-chevron');

    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = !dropdownMenu.classList.contains('hidden');
            dropdownMenu.classList.toggle('hidden', isOpen);
            chevron?.classList.toggle('rotate-180', !isOpen);
            dropdownBtn.setAttribute('aria-expanded', String(!isOpen));
        });

        document.addEventListener('click', (e) => {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                chevron?.classList.remove('rotate-180');
                dropdownBtn.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                dropdownMenu.classList.add('hidden');
                chevron?.classList.remove('rotate-180');
                dropdownBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* 
    |──────────────────────────────────────────────────────
    |   Auto-dismiss Toast setelah 4 detik
    |──────────────────────────────────────────────────────
    */
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.style.transition = 'opacity 0.4s ease';
            toast.style.opacity    = '0';
            setTimeout(() => toast.remove(), 400);
        }, 4000);
    }

});