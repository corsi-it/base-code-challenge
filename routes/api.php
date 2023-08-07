<?php

use App\Http\Controllers\AuthController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//Remember that all this routes has 'api' before, so this is actually /api/login
Route::post('/login', [AuthController::class, 'apiLogin'])->name('api_login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'apiList'])->name('get_reviews');
    Route::get('/logout', [AuthController::class, 'apiLogout'])->name('api_logout');
});

