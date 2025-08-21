<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterContactRequest;
use App\Services\ContactRegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WaitingListController extends Controller
{
    public function show(): View
    {
        return view('pages.waiting-list');
    }

    public function store(
        RegisterContactRequest $request,
        ContactRegistrationService $service
    ): RedirectResponse {
        $contact = $service->register(email: $request->get('email'));

        $subscribedPending = false;

        if (!$contact->verified_at) {
            $service->sendVerificationEmail($contact);
            $subscribedPending = true;
        }

        return redirect()
            ->route('waiting-list')
            ->with('subscribed_pending', $subscribedPending);
    }

    public function verify(
        string $token,
        Request $request,
        ContactRegistrationService $service
    ): RedirectResponse {
        $verified = $service->verify(token: $token, email: $request->query('email'));
        return redirect()
            ->route('waiting-list')
            ->with('subscribed_verified', $verified);
    }
}
