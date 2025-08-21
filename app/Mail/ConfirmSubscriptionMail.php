<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class ConfirmSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $verifyUrl)
    {
    }


    /**
     * Get the message envelope.
     */
    public function build(): self
    {
        return $this->markdown('mail.subscription.confirm')
            ->subject('Confirm your WizardCompass early access')
            ->with(['verifyUrl' => $this->verifyUrl])
            ->from(new Address('hello@updates.leopoletto.dev', 'Leonardo Poletto'));
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.subscription.confirm',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
