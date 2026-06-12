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
/* Mobile menu                                                         */
/* ------------------------------------------------------------------ */
function initMobileMenu() {
    const toggle = document.querySelector('[data-menu-toggle]');
    const panel = document.querySelector('[data-menu-panel]');
    if (!toggle || !panel) return;

    const setOpen = (open) => {
        toggle.setAttribute('aria-expanded', String(open));
        panel.classList.toggle('hidden', !open);
        // Lock body scroll while the overlay menu is open
        document.body.classList.toggle('overflow-hidden', open);
    };

    toggle.addEventListener('click', () => {
        const open = toggle.getAttribute('aria-expanded') === 'true';
        setOpen(!open);
    });

    // Close when a nav link is tapped
    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') setOpen(false);
    });

    // Reset when resizing up to desktop
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => {
        if (e.matches) setOpen(false);
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
    initMobileMenu();
    initParallax();
    initReveal();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}

// Re-run reveal after Livewire DOM updates (e.g. contact form success)
document.addEventListener('livewire:navigated', boot);
