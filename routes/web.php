<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'App\Http\Controllers\Web\AuthController@login')
    ->name('login');
Route::post('/login', 'App\Http\Controllers\Web\AuthController@loginProcess')
    ->name('login.store');

Route::get('/dashboard', 'App\Http\Controllers\Web\DashboardController@index')
    ->name('dashboard')
    ->middleware(['auth']);

Route::get('/dashboard/items', 'App\Http\Controllers\Web\ItemsController@index')
    ->name('items.index')
    ->middleware(['auth']);

Route::get('/dashboard/items/{id}', 'App\Http\Controllers\Web\ItemsController@show')
    ->name('items.show')
    ->middleware(['auth']);

Route::get('/dashboard/stock-requests', 'App\Http\Controllers\Web\StockRequestsController@index')
    ->name('stockRequests.index')
    ->middleware(['auth']);

Route::get('/dashboard/stock-requests/create', 'App\Http\Controllers\Web\StockRequestsController@create')
    ->name('stockRequests.create')
    ->middleware(['auth']);

Route::post('/dashboard/stock-requests', 'App\Http\Controllers\Web\StockRequestsController@store')
    ->name('stockRequests.store')
    ->middleware(['auth']);
