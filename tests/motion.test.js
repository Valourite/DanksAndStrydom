import test from 'node:test';
import assert from 'node:assert/strict';
import { initReveal } from '../resources/js/motion.js';

function fixture() {
    const classes = new Set();
    const item = { dataset: {}, classList: { add: x => classes.add(x), remove: x => classes.delete(x) } };
    return { item, classes, root: { querySelectorAll: () => item.dataset.revealReady ? [] : [item] } };
}

test('reveals on intersection once without reobserving initialized elements', () => {
    const { item, classes, root } = fixture();
    let notify, observed = 0, unobserved = 0;
    class Observer {
        constructor(callback) { notify = callback; }
        observe() { observed++; }
        unobserve() { unobserved++; }
    }
    initReveal(root, { matches: false }, Observer);
    assert.equal(classes.size, 0);
    notify([{ target: item, isIntersecting: false }]);
    assert.equal(classes.size, 0);
    notify([{ target: item, isIntersecting: true }]);
    assert.equal(classes.has('is-visible'), true);
    assert.equal(unobserved, 1);
    initReveal(root, { matches: false }, Observer);
    assert.equal(observed, 1);
});

test('reduced motion and missing or failing observers leave content unmodified', () => {
    for (const [matches, Observer] of [[true, class { constructor() { throw Error(); } }], [false, null], [false, class { constructor() { throw Error(); } }]]) {
        const { root, classes, item } = fixture();
        assert.doesNotThrow(() => initReveal(root, { matches }, Observer));
        assert.equal(classes.size, 0);
        assert.equal(item.dataset.revealReady, undefined);
    }
});
