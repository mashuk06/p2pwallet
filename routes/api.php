<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegistrationController;

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
Route::group(['prefix' => 'v1'], function () {
    //Api Auth Routes
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegistrationController::class, 'register']);

    //logout route via sanctum
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [LogoutController::class, 'logout']);
    });
});
