/**
 * Danks & Strydom Physiotherapy — front-end interactions.
 *
 * Pure vanilla JS, no framework. Handles:
 *  - sticky header background/shadow state on scroll
 *  - accessible mobile menu (toggle, Escape, link close)
 *  - subtle parallax on [data-parallax] elements (desktop, motion-allowed)
 *  - scroll-reveal of [.reveal] elements via IntersectionObserver
 */

// Tag the document so CSS can gate "hidden until revealed" styles
// behind JS actually being available (no-JS users see everything).
document.documentElement.classList.add('js');

const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
).matches;

/* ------------------------------------------------------------------ */
/* Sticky header state                                                 */
/* ------------------------------------------------------------------ */
function initHeader() {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;

    const onScroll = () => {
        if (window.scrollY > 24) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

/* ------------------------------------------------------------------ */
/* Mobile menu side-effects (state lives in the Livewire header)       */
/* ------------------------------------------------------------------ */
function initMobileMenu() {
    // Lock body scroll while the menu is open
    window.addEventListener('mobile-menu-toggled', (e) => {
        document.body.classList.toggle('overflow-hidden', Boolean(e.detail?.open));
    });

    // Close the menu when resizing up to desktop
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => {
        if (e.matches && window.Livewire) {
            window.Livewire.dispatch('close-mobile-menu');
        }
    });
}

/* ------------------------------------------------------------------ */
/* Parallax — translate decorative layers a fraction of scroll         */
/* ------------------------------------------------------------------ */
function initParallax() {
    if (prefersReducedMotion) return;
    if (!window.matchMedia('(min-width: 768px)').matches) return;

    const layers = Array.from(document.querySelectorAll('[data-parallax]'));
    if (layers.length === 0) return;

    let ticking = false;

    const update = () => {
        const scrollY = window.scrollY;
        for (const el of layers) {
            const speed = parseFloat(el.dataset.parallax) || 0.15;
            el.style.transform = `translate3d(0, ${scrollY * speed}px, 0)`;
        }
        ticking = false;
    };

    const onScroll = () => {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    };

    update();
    window.addEventListener('scroll', onScroll, { passive: true });
}

/* ------------------------------------------------------------------ */
/* Scroll reveal                                                       */
/* ------------------------------------------------------------------ */
function initReveal() {
    const items = document.querySelectorAll('.reveal');
    if (items.length === 0) return;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -10% 0px', threshold: 0.12 }
    );

    items.forEach((el) => observer.observe(el));
}

/* ------------------------------------------------------------------ */
/* Boot                                                                */
/* ------------------------------------------------------------------ */
function boot() {
    initHeader();
    initParallax();
    initReveal();
}

// Window-level listeners — register once, no DOM needed.
initMobileMenu();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}

// Re-run reveal after Livewire DOM updates (e.g. contact form success)
document.addEventListener('livewire:navigated', boot);
