<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DrinkController;
use App\Http\Controllers\Api\InputController;
use App\Http\Controllers\Api\OutputController;
use App\Http\Controllers\Api\ProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('inputs', InputController::class);

Route::apiResource('outputs', OutputController::class);

Route::apiResource('customers', CustomerController::class);

Route::apiResource('providers', ProviderController::class);

Route::apiResource('drinks', DrinkController::class);

Route::get('inputs-limit', [InputController::class, 'getLimit'])->name('input.limit');
Route::get('outputs-limit', [OutputController::class, 'getLimit'])->name('outputs.limit');

Route::get('transaction-inputs/{id}', [InputController::class, 'transaction_provider'])->name('input.transaction');
Route::get('transaction-outputs/{id}', [OutputController::class, 'transaction_customer'])->name('outputs.transaction');

Route::get('bilan-inputs-period/{period}', [InputController::class, 'transaction_bilan_period'])->name('input.bilan.period');
Route::get('bilan-outputs-period/{period}', [OutputController::class, 'transaction_bilan_period'])->name('outputs.bilan.period');
Route::get('bilan-inputs-date/{date1}/{date2}', [InputController::class, 'transaction_bilan_date'])->name('input.bilan.date');
Route::get('bilan-outputs-date/{date1}/{date2}', [OutputController::class, 'transaction_bilan_date'])->name('outputs.bilan.date');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
