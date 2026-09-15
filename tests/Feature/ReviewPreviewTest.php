<?php

use App\Support\Site;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    RateLimiter::clear('site-review:'.hash('sha256', '127.0.0.1'));
    config(['site.review_preview' => true, 'site.review_username' => 'reviewer', 'site.review_password_hash' => password_hash('test-review-only', PASSWORD_BCRYPT)]);
});

it('requires authentication for all staging review pages and does not retain access', function () {
    app()->detectEnvironment(fn () => 'staging');
    $this->get('https://staging.example.test/about')->assertUnauthorized()->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    $this->withBasicAuth('reviewer', 'test-review-only')->get('https://staging.example.test/about')->assertOk()
        ->assertSee('extensive experience in human and equine physiotherapy')->assertSee('Missing optional information: Exact qualifications.')->assertSee('Missing optional information: Approved photograph and alt text.')
        ->assertHeader('Cache-Control', 'no-store, private');
    $this->withBasicAuth('wrong', 'wrong')->get('https://staging.example.test/about')->assertUnauthorized();
    $this->get('https://staging.example.test/')->assertUnauthorized();
});

it('never exposes drafts or draft links in production even with review credentials and flags', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.indexable' => true, 'app.url' => 'https://danksandstrydom.co.za']);
    foreach (['about', 'back-neck-pain', 'sports-injury-rehabilitation', 'post-operative-rehabilitation', 'patient-information'] as $name) {
        config(["site.pages.$name.published" => false]);
        $this->withBasicAuth('reviewer', 'test-review-only')->get('https://danksandstrydom.co.za'.config("site.pages.$name.path").'?preview=true')->assertNotFound();
        $this->get('https://danksandstrydom.co.za/')->assertDontSee('href="'.route($name).'"', false);
        $this->get('https://danksandstrydom.co.za/sitemap.xml')->assertDontSee('<loc>'.Site::url(config("site.pages.$name.path")).'</loc>', false);
    }
    $this->get('https://danksandstrydom.co.za/contact')->assertOk()->assertSee('Walk-ins can be accommodated');
});

it('keeps published policies and services protected in authenticated staging', function () {
    app()->detectEnvironment(fn () => 'staging');
    $this->withBasicAuth('reviewer', 'test-review-only');
    $this->get('https://staging.example.test/patient-information')->assertOk()
        ->assertSee('Appointments are one hour')->assertSee('without a doctor’s referral')
        ->assertSee('you may be liable for the full appointment fee')->assertSee('confirm medical-aid claim arrangements')
        ->assertSee('Missing optional information: Submitting medical-aid claims.')->assertDontSee('claims are declined');
    foreach (['back-neck-pain', 'sports-injury-rehabilitation', 'post-operative-rehabilitation'] as $name) {
        $this->get('https://staging.example.test'.config("site.pages.$name.path"))->assertOk()
            ->assertSee('patient-information form')->assertSee('Patients are not expected to bring anything')->assertDontSee('Placeholder');
    }
    $this->get('https://staging.example.test/contact')->assertSee('Walk-ins can be accommodated only');
    $this->get('https://staging.example.test/sitemap.xml')->assertDontSee('<loc>', false);
});

it('fails closed for absent credentials, invalid hashes and insecure staging', function () {
    app()->detectEnvironment(fn () => 'staging');
    $this->withBasicAuth('reviewer', 'test-review-only')->get('http://staging.example.test/about')->assertStatus(503);
    config(['site.review_password_hash' => '']);
    $this->get('https://staging.example.test/about')->assertStatus(503);
    config(['site.review_password_hash' => 'invalid']);
    $this->get('https://staging.example.test/about')->assertUnauthorized();
    config(['site.review_preview' => false]);
    $this->get('https://staging.example.test/about')->assertOk()->assertDontSee('Missing optional information:')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
});

it('throttles failed review authentication attempts', function () {
    app()->detectEnvironment(fn () => 'staging');
    for ($attempt = 0; $attempt < 10; $attempt++) {
        $this->withBasicAuth('wrong', 'wrong')->get('https://staging.example.test/about')->assertUnauthorized();
    }
    $this->get('https://staging.example.test/about')->assertStatus(429);
});
