<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#Controllers 
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherController;


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


Route::post('/register',[UserController::class, 'register']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('voucher')->group(function() {

    Route::get('/',[VoucherController::class, 'index']);
    Route::post('/create',[VoucherController::class, 'store']);
    Route::delete('/delete',[VoucherController::class, 'delete']);


});

