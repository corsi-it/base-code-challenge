<?php

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Inventory\InventoryController;
use App\Http\Controllers\Api\User\RequestController;
use App\Http\Controllers\Api\User\WelcomePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/cars', [WelcomePageController::class, 'welcomePage'])->name('welcomePage');
Route::get('/categories', [CategoryController::class, 'getCategories'])->name('getCategories');
Route::middleware('auth:sanctum')->group(function () {('createInventory');
    Route::prefix('/inventory')->group(function(){
        Route::post('/create', [InventoryController::class, 'create'])->name('createInventory');
        Route::post('/update', [InventoryController::class, 'update'])->name('updateInventory');
        Route::post('/delete', [InventoryController::class, 'delete'])->name('deleteInventory');
    });
    Route::prefix('/request')->group(function(){
        Route::post('/item', [RequestController::class, 'send'])->name('requestItem');
        Route::post('/all', [AdminController::class, 'getUserRequests'])->name('getUserRequests');
    });
    Route::post('/set-status', [AdminController::class, 'setStatus'])->name('setStatus');
});



