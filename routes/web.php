<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\WalletDashboard;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/wallet-dashboard', WalletDashboard::class)->name('wallet-dashboard');
});
