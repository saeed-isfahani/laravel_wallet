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

Route::prefix('v1')->group(function () {
    Route::post('/payments', [PaymentController::class, 'store']);
    // TODO use Route Model binding for unique_id and change default field in model for all end points
    Route::get('/payments/{unique_id}', [PaymentController::class, 'show']);
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::patch('/payments/{unique_id}/approve', [PaymentController::class, 'approve']);
    Route::patch('/payments/{unique_id}/reject', [PaymentController::class, 'reject']);
    Route::post('/currencies', [CurrencyController::class, 'store']);
    Route::get('/currencies', [CurrencyController::class, 'index']);
    Route::post('/deposits/transfer', [DepositController::class, 'transfer']);
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
