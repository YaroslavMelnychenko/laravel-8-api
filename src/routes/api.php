<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

Route::get('/', [ApiController::class, 'index']);

Route::prefix('/test')->name('test.')->group(function() {
    Route::get('/redis', [ApiController::class, 'testRedis'])->name('redis');
    Route::get('/storage', [ApiController::class, 'testStorage'])->name('storage');
    Route::get('/job/{delay}', [ApiController::class, 'testJob'])->name('job');
});
