import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/* 
|──────────────────────────────────────────────────────────────────────────────────
|   Import Lucide Icons
|──────────────────────────────────────────────────────────────────────────────────
*/
import { createIcons, ChevronUp, ChevronDown, ChevronsRight, ArrowUpRight, Shirt, Flag, ShieldCheck, Users, Wifi, Sparkle, Tags, Clock, Layers, Van, Headset, Star, ArrowLeft, ArrowRight, MapPin, Mail, Phone, Telescope, Rocket, X, ZoomIn, CheckCircle, AlertCircle, BadgeCheck, Award, ClipboardCheck, Feather, Cpu, BadgePercent } from 'lucide';

const allIcons = {
    'chevron-up': ChevronUp,
    'chevron-down': ChevronDown,
    'chevrons-right': ChevronsRight,
    'arrow-up-right': ArrowUpRight,
    shirt: Shirt,
    flag: Flag,
    'shield-check': ShieldCheck,
    users: Users,
    wifi: Wifi,
    sparkle: Sparkle,
    tags: Tags,
    clock: Clock,
    layers: Layers,
    van: Van,
    headset: Headset,
    star: Star,
    'arrow-left': ArrowLeft,
    'arrow-right': ArrowRight,
    'map-pin': MapPin,
    mail: Mail,
    phone: Phone,
    telescope: Telescope,
    rocket: Rocket,
    x: X,
    'zoom-in': ZoomIn,
    'check-circle': CheckCircle,
    'alert-circle': AlertCircle,
    'badge-check': BadgeCheck,
    award: Award,
    'clipboard-check': ClipboardCheck,
    feather: Feather,
    cpu: Cpu,
    'badge-percent': BadgePercent,
    ChevronUp,
    ChevronDown,
    ChevronsRight,
    ArrowUpRight,
    Shirt,
    Flag,
    ShieldCheck,
    Users,
    Wifi,
    Sparkle,
    Tags,
    Clock,
    Layers,
    Van,
    Headset,
    Star,
    ArrowLeft,
    ArrowRight,
    MapPin,
    Mail,
    Phone,
    Telescope,
    Rocket,
    X,
    ZoomIn,
    CheckCircle,
    AlertCircle,
    BadgeCheck,
    Award,
    ClipboardCheck,
    Feather,
    Cpu,
    BadgePercent,
};

window.lucide = { createIcons, icons: allIcons };

/* 
|──────────────────────────────────────────────────────────────────────────────────
|   Custom Scroll Animation (pengganti AOS)
|──────────────────────────────────────────────────────────────────────────────────
*/
const initScrollAnimation = () => {
    const elements = document.querySelectorAll('[data-aos]');
    if (!elements.length) return;

    // Reset semua elemen ke state awal
    elements.forEach(el => {
        el.classList.remove('aos-animate');
        el.style.transitionDelay = el.dataset.aosDelay ? `${el.dataset.aosDelay}ms` : '100ms';
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
                observer.unobserve(entry.target); // animasi 1x saja per load
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => observer.observe(el));
};

document.addEventListener('DOMContentLoaded', () => {
    createIcons({
        icons: allIcons,
        attrs: { 
            width: 24, 
            height: 24, 
            'stroke-width': 1.75 
        }
    });

    initScrollAnimation();
});

// Refresh setelah semua asset selesai load (gambar, font, dll)
window.addEventListener('load', () => initScrollAnimation());

// Handle bfcache — tombol back/forward browser
window.addEventListener('pageshow', (e) => {
    if (e.persisted) initScrollAnimation();
});