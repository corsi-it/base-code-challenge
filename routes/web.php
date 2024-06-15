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

Route::get('/', 'App\Http\Controllers\Web\DefaultController@index')->name('home');
Route::get('/login', 'App\Http\Controllers\Web\AuthController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\Web\AuthController@loginStore')->name('login.store');

// Group routes that only require 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Web\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/logout', 'App\Http\Controllers\Web\AuthController@logout')->name('logout');
    Route::get('/dashboard/stock-requests', 'App\Http\Controllers\Web\StockRequestsController@index')->name('stockRequests.index');
    Route::get('/dashboard/stock-requests/create', 'App\Http\Controllers\Web\StockRequestsController@create')->name('stockRequests.create');
    Route::post('/dashboard/stock-requests', 'App\Http\Controllers\Web\StockRequestsController@store')->name('stockRequests.store');
    Route::get('/dashboard/stock-requests/{id}', 'App\Http\Controllers\Web\StockRequestsController@show')->name('stockRequests.show');
    Route::get('/dashboard/stock-requests/{id}/edit', 'App\Http\Controllers\Web\StockRequestsController@edit')->name('stockRequests.edit');
});

// Group routes that require both 'auth' and 'role.admin' middleware
Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/dashboard/charts/user-requests', 'App\Http\Controllers\Web\ChartController@userRequests')->name('charts.userRequests');
    Route::get('/dashboard/charts/item-requests', 'App\Http\Controllers\Web\ChartController@itemRequests')->name('charts.itemRequests');
    Route::get('/dashboard/items', 'App\Http\Controllers\Web\ItemsController@index')->name('items.index');
    Route::get('/dashboard/items/create', 'App\Http\Controllers\Web\ItemsController@create')->name('items.create');
    Route::post('/dashboard/items', 'App\Http\Controllers\Web\ItemsController@store')->name('items.store');
    Route::get('/dashboard/items/{id}', 'App\Http\Controllers\Web\ItemsController@show')->name('items.show');
    Route::get('/dashboard/items/{id}/edit', 'App\Http\Controllers\Web\ItemsController@edit')->name('items.edit');
    Route::put('/dashboard/items/{id}', 'App\Http\Controllers\Web\ItemsController@update')->name('items.update');
    Route::get('/dashboard/stock-requests/{id}/edit', 'App\Http\Controllers\Web\StockRequestsController@edit')->name('stockRequests.edit');
    Route::put('/dashboard/stock-requests/{id}', 'App\Http\Controllers\Web\StockRequestsController@update')->name('stockRequests.update');
});