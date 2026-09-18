import test from 'node:test';
import assert from 'node:assert/strict';
import { createTracker } from '../resources/js/analytics.js';

test('deduplicates success and sends only generic allowlisted events', () => {
    const events = [];
    const track = createTracker((event) => events.push(event));
    const id = '00000000-0000-4000-8000-000000000001';
    track('enquiry_accepted', id);
    track('enquiry_accepted', id);
    track('enquiry_accepted', 'private@example.test');
    track('clinical_selection', 'back pain');
    track('phone_click', '+27115550000');
    track('directions_click', 'private address');
    assert.deepEqual(events, [{ event: 'enquiry_accepted' }, { event: 'phone_click' }, { event: 'directions_click' }]);
});

test('disabled integration registers no listeners or provider', async () => {
    const { installTracking } = await import('../resources/js/analytics.js');
    globalThis.document = { body: { dataset: { analyticsEnabled: 'false' } } };
    assert.doesNotThrow(() => installTracking());
    delete globalThis.document;
});
