<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterContactRequest;
use App\Services\ContactRegistrationService;
use Illuminate\Http\RedirectResponse;
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
        $service->register(email: $request->get('email'));

        return redirect()->back()->with([
            'message' => 'Thanks for registering with us!'
        ]);
    }
}
