<?php

use App\Http\Middleware\SecurityHeaders;
use App\Mail\ContactCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Resend\Client;

Route::middleware(SecurityHeaders::class)->group(function () {
    Route::get('/', fn() => view('pages.waiting-list'))->name('waiting-list');

    Route::post('/register', function (Client $resend, Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email:rfc',
        ]);

        $resend->contacts->create(
            audienceId: config('services.resend.audienceId'),
            parameters: ['email' => $validatedData['email'], 'unsubscribed' => false]
        );

        Mail::to($validatedData['email'])->send(new ContactCreated());

        return redirect()->back()->with([
            'message' => 'Thanks you for registering with us'
        ]);
    })->middleware('throttle:60,1')->name('register.contact');
});

Route::post('/csp-report', function (Request $request) {
    Log::warning('CSP Violation Header', [
        'headers' => $request->headers->all(),
        'body' => $request->all(),
    ]);

    return response()->noContent();
})->middleware('throttle:60,1')->name('csp.report');
