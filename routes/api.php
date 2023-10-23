<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DepositController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;

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
    Route::post('/deposit/transfer', [DepositController::class, 'transfer']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
