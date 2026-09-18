/** Reveal only when observed: uninitialised or failed JavaScript never hides content. */
export function initReveal(root = document, media = window.matchMedia('(prefers-reduced-motion: reduce)'), Observer = window.IntersectionObserver) {
    const items = [...root.querySelectorAll('.reveal:not([data-reveal-ready])')];
    if (media.matches || !Observer || items.length === 0) return;

    let observer;
    try {
        observer = new Observer((entries) => {
            entries.forEach(({ isIntersecting, target }) => {
                if (!isIntersecting) return;
                target.classList.add('is-visible');
                observer.unobserve(target);
            });
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.12 });
        items.forEach((item) => {
            observer.observe(item);
            item.dataset.revealReady = 'true';
        });
    } catch {
        observer?.disconnect();
        // Base CSS is visible, including if observer construction or setup fails.
        items.forEach((item) => item.classList.remove('is-visible'));
    }
}
