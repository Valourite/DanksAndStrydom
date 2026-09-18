// Only generic events leave this adapter. A reviewed provider may listen for site:analytics.
export function createTracker(send) {
    const accepted = new Set();
    return (name, id) => {
        if (!['enquiry_accepted', 'phone_click', 'directions_click'].includes(name)) return;
        if (name === 'enquiry_accepted') {
            if (typeof id !== 'string' || !/^[0-9a-f-]{36}$/.test(id) || accepted.has(id)) return;
            accepted.add(id);
        }
        send({ event: name });
    };
}

export function installTracking() {
    if (document.body.dataset.analyticsEnabled !== 'true') return;
    const track = createTracker((payload) => window.dispatchEvent(new CustomEvent('site:analytics', { detail: payload })));
    window.addEventListener('enquiry-accepted', (event) => track('enquiry_accepted', event.detail?.id));
    document.addEventListener('click', (event) => {
        const link = event.target.closest?.('a[data-contact-action]');
        if (link?.dataset.contactAction === 'phone') track('phone_click');
        if (link?.dataset.contactAction === 'directions') track('directions_click');
    });
}
