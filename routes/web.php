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

Route::get('/dashboard/logout', 'App\Http\Controllers\Web\AuthController@logout');

Route::get('/dashboard/charts/user-requests', 'App\Http\Controllers\Web\ChartController@userRequests')
    ->name('charts.userRequests')
    ->middleware(['auth']);

Route::get('/dashboard/charts/item-requests', 'App\Http\Controllers\Web\ChartController@itemRequests')
    ->name('charts.itemRequests')
    ->middleware(['auth']);

Route::get('/dashboard/items', 'App\Http\Controllers\Web\ItemsController@index')
    ->name('items.index')
    ->middleware(['auth']);

Route::get('/dashboard/items/create', 'App\Http\Controllers\Web\ItemsController@create')
    ->name('items.create')
    ->middleware(['auth']);

Route::post('/dashboard/items', 'App\Http\Controllers\Web\ItemsController@store')
    ->name('items.store')
    ->middleware(['auth']);

Route::get('/dashboard/items/{id}', 'App\Http\Controllers\Web\ItemsController@show')
    ->name('items.show')
    ->middleware(['auth']);

Route::get('/dashboard/items/{id}/edit', 'App\Http\Controllers\Web\ItemsController@edit')
    ->name('items.edit')
    ->middleware(['auth']);

Route::put('/dashboard/items/{id}', 'App\Http\Controllers\Web\ItemsController@update')
    ->name('items.update')
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

Route::get('/dashboard/stock-requests/{id}', 'App\Http\Controllers\Web\StockRequestsController@show')
    ->name('stockRequests.show')
    ->middleware(['auth']);

Route::get('/dashboard/stock-requests/{id}/edit', 'App\Http\Controllers\Web\StockRequestsController@edit')
    ->name('stockRequests.edit')
    ->middleware(['auth']);

Route::put('/dashboard/stock-requests/{id}', 'App\Http\Controllers\Web\StockRequestsController@update')
    ->name('stockRequests.update')
    ->middleware(['auth']);
