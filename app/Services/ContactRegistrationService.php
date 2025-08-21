<?php

namespace App\Services;

use App\Mail\ConfirmSubscriptionMail;
use App\Models\Contact;
use Illuminate\Mail\SentMessage;
use Log;
use Mail;
use Resend\Client;
use Str;


class ContactRegistrationService
{
    public function __construct(public Client $resend)
    {
    }

    public function register(string $email): Contact
    {
        $contact = Contact::create([
            'email' => $email,
            'audience_id' => config('services.resend.audienceId'),
            'unsubscribed' => false,
            'verify_token' => Str::random(40)
        ]);

        try {
            $resendContact = $this->resend->contacts->create(
                audienceId: config('services.resend.audienceId'),
                parameters: ['email' => $contact->email, 'unsubscribed' => false]
            );

            $contact->update([
                'resend_id' => $resendContact->id,
            ]);

        } catch (\Throwable $th) {
            Log::error('Contact registration failed: '.$contact->email, [
                'exception' => $th,
            ]);
        }

        return $contact;
    }

    public function sendVerificationEmail(Contact $contact): ?SentMessage
    {
        $verifyUrl = route('subscriber.verify', [
                'token' => $contact->verify_token, 'email' => urlencode($contact->email)
            ]
        );

        return Mail::to($contact->email)->send(new ConfirmSubscriptionMail($verifyUrl));
    }

    public function verify(string $token, ?string $email): bool
    {
        $query = Contact::query()
            ->where('verify_token', $token);

        if ($email) {
            $query->where('email', urldecode($email));
        };

        $subQuery = $query->first();

        if (!$subQuery) {
            return false;
        };

        $subQuery->forceFill(['verified_at' => now(), 'verify_token' => null])
            ->save();

        return true;
    }
}
