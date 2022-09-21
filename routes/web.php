<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to(route('write'));
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('write', function () {
        return redirect()->to(route('write.date', ['date' => today()->format('Ymd')]));
    })->name('write');

    Route::get('write/{date}', [WriteController::class, 'render'])->name('write.date');
    Route::post('write/{date}', [WriteController::class, 'store'])->name('write.store')->middleware('subscribed-or-trial');
    Route::get('write/{date}/stable-diffusion', [WriteController::class, 'getImages'])->name('write.stable-diffusion')->middleware('subscribed-or-trial');
    Route::post('write/{date}/stable-diffusion', [WriteController::class, 'generateImages'])->middleware('subscribed-or-trial');
    Route::get('subscribe', [SubscriptionController::class, 'render'])->name('subscribe.landing')->middleware('not-subscribed');

    Route::get('/billing-portal', function (Request $request) {
        return $request->user()->redirectToBillingPortal(route('write'));
    })->name('billing-portal');
    Route::get('/subscription-checkout', function (Request $request) {
        return $request->user()
            ->newSubscription('default', config('services.stripe.monthly_plan'))
            ->checkout([
                'success_url' => route('write'),
                'cancel_url' => route('subscribe.landing'),
            ]);
    })->name('subscribe')->middleware('not-subscribed');
});

Route::stripeWebhooks('stripe/webhook');

require __DIR__.'/auth.php';
