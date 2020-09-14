<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;

use App\Http\Controllers\Api\UserController;
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

Route::prefix('/')->name('api.')->group(function() {
    Route::get('/', [ApiController::class, 'index'])->name('index');

    Route::prefix('/test')->name('test.')->group(function() {
        Route::get('/redis', [ApiController::class, 'testRedis'])->name('redis');
        Route::get('/storage', [ApiController::class, 'testStorage'])->name('storage');
        Route::get('/job/{delay}', [ApiController::class, 'testJob'])->name('job');
    });

    Route::prefix('/auth')->name('auth.')->group(function() {
        Route::post('/login', LoginController::class)->name('login');
        Route::post('/register', RegisterController::class)->name('register');
        Route::post('/logout', LogoutController::class)->middleware('auth:api')->name('logout');
    });

    Route::middleware('auth:api')->group(function() {
        Route::resource('/users', UserController::class)->only('index');
    });
});