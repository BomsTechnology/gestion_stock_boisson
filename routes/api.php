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
Route::get('transaction-inputs-drinks/{id}', [InputController::class, 'transaction_drinks'])->name('input.transaction');
Route::get('transaction-outputs-drinks/{id}', [OutputController::class, 'transaction_drinks'])->name('outputs.transaction');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
