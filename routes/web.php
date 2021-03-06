<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\WalletDashboard;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[DashboardController::class,'index'])->name('dashboard');


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/wallet-dashboard', WalletDashboard::class)->name('wallet-dashboard');
    Route::post('/store-transaction',[TransactionController::class,'store'])->name('store-transaction');
    Route::get('/exchange-rate', [ExchangeRateController::class,'index'])->name('exchange-rate');
});
