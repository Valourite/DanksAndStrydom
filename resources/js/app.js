/**
 * Danks & Strydom Physiotherapy — front-end interactions.
 *
 * Pure vanilla JS, no framework. Handles:
 *  - sticky header background/shadow state on scroll
 *  - accessible mobile menu (toggle, Escape, link close)
 *  - subtle parallax on [data-parallax] elements (desktop, motion-allowed)
 *  - scroll-reveal of [.reveal] elements via IntersectionObserver
 *  - desktop image carousel lightbox
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
    const header = document.querySelector('[data-site-header]');
    if (!header || header.dataset.mobileMenuInitialized === 'true') return;

    const toggle = header.querySelector('[data-mobile-menu-toggle]');
    const menu = header.querySelector('[data-mobile-menu]');

    if (!toggle || !menu) return;

    header.dataset.mobileMenuInitialized = 'true';

    const setMenuOpen = (open) => {
        header.dataset.menuOpen = String(open);
        menu.hidden = !open;
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        document.body.classList.toggle('overflow-hidden', open);
    };

    const isMenuOpen = () => toggle.getAttribute('aria-expanded') === 'true';

    toggle.addEventListener('click', () => {
        setMenuOpen(!isMenuOpen());
    });

    header.querySelectorAll('[data-mobile-menu-close]').forEach((link) => {
        link.addEventListener('click', () => setMenuOpen(false));
    });

    header.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && isMenuOpen()) {
            setMenuOpen(false);
            toggle.focus();
        }
    });

    window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
        if (event.matches) {
            setMenuOpen(false);
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
/* Desktop image carousel lightbox                                    */
/* ------------------------------------------------------------------ */
function initImageCarousels() {
    document.querySelectorAll('[data-image-carousel]').forEach((carousel) => {
        if (carousel.dataset.initialized === 'true') return;

        const dialog = carousel.querySelector('[data-carousel-dialog]');
        const dialogImage = carousel.querySelector('[data-carousel-dialog-image]');
        const closeButton = carousel.querySelector('[data-carousel-dialog-close]');

        if (!dialog || !dialogImage || !closeButton) return;

        carousel.dataset.initialized = 'true';
        let previouslyFocusedElement = null;

        const closeDialog = () => {
            if (dialog.open) {
                dialog.close();
            }
        };

        carousel.querySelectorAll('[data-carousel-image]').forEach((button) => {
            button.addEventListener('click', () => {
                if (!window.matchMedia('(min-width: 768px)').matches) return;

                previouslyFocusedElement = button;
                dialogImage.src = button.dataset.imageSrc;
                dialogImage.alt = button.dataset.imageAlt;
                dialog.showModal();
                document.body.classList.add('overflow-hidden');
            });
        });

        closeButton.addEventListener('click', closeDialog);
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) {
                closeDialog();
            }
        });
        dialog.addEventListener('close', () => {
            document.body.classList.remove('overflow-hidden');
            dialogImage.src = '';
            dialogImage.alt = '';
            previouslyFocusedElement?.focus();
        });

        window.matchMedia('(max-width: 767px)').addEventListener('change', (event) => {
            if (event.matches) {
                closeDialog();
            }
        });
    });
}

/* ------------------------------------------------------------------ */
/* Boot                                                                */
/* ------------------------------------------------------------------ */
function boot() {
    initHeader();
    initMobileMenu();
    initParallax();
    initReveal();
    initImageCarousels();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}

// Re-run reveal after Livewire DOM updates (e.g. contact form success)
document.addEventListener('livewire:navigated', boot);
