<?php

use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\CarTypeController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('test', function(){
    echo 'Test';
});

Route::prefix('auth')->group(function(){
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('login-PGCT', [ApiAuthController::class, 'loginPGCT']);
    Route::post('forget-password', [ApiAuthController::class, 'forgetPassword']);
    Route::post('reset-password', [ApiAuthController::class, 'resetPassword']);
});

Route::get('types', [TypeController::class, 'index']);

Route::middleware('auth:admin-api')->group(function(){
    Route::apiResource('car-types', CarTypeController::class);
});

Route::post('login', [UserController::class, 'access_token']);
Route::post('refresh_token', [UserController::class, 'refresh_token']);

Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::get('user/{user_id?}', [UserController::class, 'getUser']);
    Route::post('user', [UserController::class, 'postUser']);
    Route::put('user', [UserController::class, 'putUser']);
    Route::delete('user', [UserController::class, 'deleteUser']);
});



Route::prefix('auth')->middleware('auth:admin-api')->group(function(){
    Route::get('logout', [ApiAuthController::class, 'logout']);
});

Route::get('laravel-10', function(){
    return response()->json(['message' => 'Welcome In API - Eloquent']);
});
