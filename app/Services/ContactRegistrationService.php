<?php

namespace App\Services;

use App\Mail\ContactCreated;
use App\Models\Contact;
use Mail;
use Resend\Client;


class ContactRegistrationService
{
    public function __construct(public Client $resend)
    {
    }

    public function register(string $email): Contact
    {
        $contact = $this->resend->contacts->create(
            audienceId: config('services.resend.audienceId'),
            parameters: ['email' => $email, 'unsubscribed' => false]
        );


        $contact = Contact::create([
            'email' => $email,
            'audience_id' => config('services.resend.audienceId'),
            'resend_id' => $contact->id,
            'unsubscribed' => false,
        ]);

        Mail::to($email)->send(new ContactCreated);

        return $contact;
    }
}
