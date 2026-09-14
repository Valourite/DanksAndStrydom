<?php

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Cache::flush();
});
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;

it('validates required fields', function () {
    Mail::fake();

    Livewire::test('contact-form')
        ->set('name', '')
        ->set('email', 'not-an-email')
        ->set('message', 'short')
        ->call('submit')
        ->assertHasErrors(['name', 'email', 'message']);

    Mail::assertNothingSent();
});

it('sends mail to configured recipients and shows success', function () {
    Mail::fake();
    config()->set('contact.recipients', ['info@danksandstrydom.co.za', 'admin@danksandstrydom.co.za']);

    Livewire::test('contact-form')
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('phone', '+27 11 555 1234')
        ->set('service', 'Sports injury rehabilitation')
        ->set('message', 'I would like to book an assessment for my knee, please.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertDispatched('enquiry-accepted')
        ->assertSet('sent', true)
        ->assertSet('name', '');

    Mail::assertSent(ContactFormSubmitted::class, function (ContactFormSubmitted $mail) {
        return $mail->hasTo('info@danksandstrydom.co.za')
            && $mail->hasTo('admin@danksandstrydom.co.za')
            && $mail->data['name'] === 'Jane Doe';
    });
});

it('errors gracefully when no recipients configured', function () {
    Mail::fake();
    config()->set('contact.recipients', []);

    Livewire::test('contact-form')
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('message', 'I would like to book an assessment for my knee, please.')
        ->call('submit')
        ->assertHasErrors('form')
        ->assertSet('sent', false)
        ->assertNotDispatched('enquiry-accepted');

    Mail::assertNothingSent();
});

it('does not send or track honeypot submissions', function () {
    Mail::fake();
    Livewire::test('contact-form')->set('website', 'spam')->call('submit')->assertNotDispatched('enquiry-accepted');
    Mail::assertNothingSent();
});

it('limits repeated attempts without sending mail', function () {
    Mail::fake();
    $form = Livewire::test('contact-form');
    for ($attempt = 0; $attempt < 5; $attempt++) {
        $form->call('submit');
    }
    $form->call('submit')->assertHasErrors('form')->assertNotDispatched('enquiry-accepted');
    Mail::assertNothingSent();
});

it('handles delivery exceptions without success or personal data in logs', function () {
    config(['contact.recipients' => ['qa@example.test']]);
    Mail::shouldReceive('to')->once()->andReturnSelf();
    Mail::shouldReceive('send')->once()->andThrow(new RuntimeException('private@example.test'));
    Log::spy();
    Livewire::test('contact-form')->set('name', 'Jane Doe')->set('email', 'jane@example.test')
        ->set('message', 'Please contact me about an appointment.')->call('submit')
        ->assertHasErrors('form')->assertSet('sent', false)->assertNotDispatched('enquiry-accepted');
    Log::shouldHaveReceived('error')->with('Contact form mail failed.', ['exception_type' => RuntimeException::class])->once();
});

it('sends only once for a repeated accepted submission', function () {
    Mail::fake();
    config(['contact.recipients' => ['qa@example.test']]);
    $form = Livewire::test('contact-form')->set('name', 'Jane Doe')->set('email', 'jane@example.test')
        ->set('message', 'Please contact me about an appointment.')->call('submit');
    $form->call('submit')->assertNotDispatched('enquiry-accepted');
    Mail::assertSentCount(1);
});

it('does not resend an accepted request from an older component snapshot', function () {
    Mail::fake();
    config(['contact.recipients' => ['qa@example.test']]);
    $form = Livewire::test('contact-form')->set('name', 'Jane Doe')->set('email', 'jane@example.test')
        ->set('message', 'Please contact me about an appointment.');
    Cache::put('enquiry-sent:'.$form->get('submissionId'), true, 3600);
    $form->call('submit')->assertSet('sent', true)->assertNotDispatched('enquiry-accepted');
    Mail::assertNothingSent();
});
