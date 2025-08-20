<?php

use App\Http\Controllers\WaitingListController;
use App\Http\Middleware\SecurityHeaders;
use App\Mail\ContactCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Resend\Client;

Route::middleware(SecurityHeaders::class)->group(function () {
    Route::get('/', [WaitingListController::class, 'show'])->name('waiting-list');
    Route::post('/register', [WaitingListController::class, 'store'])->name('register');
})->middleware('throttle:60,1');

Route::post('/csp-report', function (Request $request) {
    Log::warning('CSP Violation Header', [
        'headers' => $request->headers->all(),
        'body' => $request->all(),
    ]);

    return response()->noContent();
})->middleware('throttle:60,1')->name('csp.report');
