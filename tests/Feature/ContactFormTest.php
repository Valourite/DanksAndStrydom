<?php

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
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
        ->assertSet('sent', false);

    Mail::assertNothingSent();
});
