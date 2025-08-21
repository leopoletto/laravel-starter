{{-- resources/views/mail/subscription/confirm.blade.php --}}
@component('mail::message')
# Confirm your email

Thanks for joining **Wizard Compass** — interactive lessons that turn Chrome *Lighthouse* reports into real fixes.

Click the button below to confirm your email and get early access updates.

@component('mail::button', ['url' => $verifyUrl])
Confirm my email
@endcomponent

If the button doesn’t work, copy and paste this link:
{{ $verifyUrl }}

You’ll receive **one short update per week** with progress, live demos, and release dates.

— Leonardo Poletto
@endcomponent
