<?php

use App\Http\Controllers\WriteController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('write', function () {
        return redirect()->to(route('write.date', ['date' => today()->format('Ymd')]));
    })->name('write');

    Route::get('write/{date}', [WriteController::class, 'render'])->name('write.date');
    Route::post('write/{date}', [WriteController::class, 'store'])->name('write.store');
    Route::get('write/{date}/stable-diffusion', [WriteController::class, 'getImages'])->name('write.stable-diffusion');
    Route::post('write/{date}/stable-diffusion', [WriteController::class, 'generateImages']);
});

require __DIR__.'/auth.php';
