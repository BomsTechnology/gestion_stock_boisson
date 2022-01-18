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
// Route::middleware(['auth'])->group(function () {
    Route::apiResource('inputs', InputController::class);

    Route::apiResource('outputs', OutputController::class);

    Route::apiResource('customers', CustomerController::class);

    Route::apiResource('providers', ProviderController::class);

    Route::apiResource('drinks', DrinkController::class);
// });


// Route::post('inputs', [InputController::class, 'store']);

//Route::get('/inputs/{moves}', 'App\Http\Controllers\Api\InputController@store');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
