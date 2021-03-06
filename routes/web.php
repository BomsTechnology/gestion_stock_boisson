<?php

use App\Http\Controllers\Api\InputController;
use App\Http\Controllers\Api\OutputController;
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
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/customers', function () { return view('customer'); })->name('customers');
    Route::get('/providers', function () { return view('provider'); })->name('providers');
    Route::get('/inputs', function () { return view('input'); })->name('inputs');
    Route::get('/inputs/{id}/details', [InputController::class, 'details'])->name('inputs.details');
    Route::get('/outputs/{id}/details', [OutputController::class, 'details'])->name('outputs.details');
    Route::get('/outputs', function () { return view('output'); })->name('outputs');
    Route::get('/bilan', function () { return view('bilan'); })->name('bilan');
    Route::get('/drinks', function () { return view('drink'); })->name('drinks');

});

require __DIR__.'/auth.php';

Route::view('{any}', 'dashboard')->middleware('auth')->where('any', '.*');
