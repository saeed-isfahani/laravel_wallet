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
// TODO handle redirect to login route method Error
Route::prefix('v1')->group(function () {
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::get('/payments/{payment}', [PaymentController::class, 'show']);
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::patch('/payments/{payment}/approve', [PaymentController::class, 'approve']);
    Route::patch('/payments/{payment}/reject', [PaymentController::class, 'reject']);
    Route::post('/currencies', [CurrencyController::class, 'store']);
    Route::get('/currencies', [CurrencyController::class, 'index']);
    Route::post('/deposits/transfer', [DepositController::class, 'transfer']);
});

Route::prefix('auth')->middleware(['api'])->group(function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
