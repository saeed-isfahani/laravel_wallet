<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->middleware('localization')->group(function () {
    Route::post('/payment', [PaymentController::class, 'store']);
    Route::get('/payment/{unique_id}', [PaymentController::class, 'show']);
    Route::get('/payment', [PaymentController::class, 'index']);
    Route::patch('/payment/{unique_id}/approve', [PaymentController::class, 'approve']);
    Route::patch('/payment/{unique_id}/reject', [PaymentController::class, 'reject']);
    Route::post('/currency', [CurrencyController::class, 'store']);
    Route::get('/currency', [CurrencyController::class, 'index']);
});
