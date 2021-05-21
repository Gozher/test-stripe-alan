<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CreateSubscription;
use App\Http\Livewire\CreatePoducts;
use App\Http\Controllers\StripeWebHookController;

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

/*Ruta para el uso de webhooks*/
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/sub', CreateSubscription::class)->name('sub');
Route::get('/products', CreatePoducts::class)->name('products');

Route::post('/stripe/webhook', [StripeWebHookController::class, 'handleWebhook']);
