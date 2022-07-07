<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Logged\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ChatController;
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



Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'logging']);

Route::post('/logout', [LogoutController::class, 'loggout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/chat', [ChatController::class, 'chatin'])->name('chat')->middleware('auth');
Route::get('/chatRequest', [ChatController::class, 'reloadchat'])->name('chatRequest');
Route::get('/chatUpdate', [ChatController::class, 'chatUpdate'])->name('chatUpdate');
Route::post('/chatting', [ChatController::class, 'chatting'])->name('chatting');


Route::get('/processPaypal', [PaypalController::class, 'processPaypal'])->name('processPaypal');
Route::get('/processSuccess', [PaypalController::class, 'processSuccess'])->name('processSuccess');
Route::get('/processCancel', [PaypalController::class, 'processCancel'])->name('processCancel');

Route::get('/', function () {
    return view('body.index');
})->name('home');
