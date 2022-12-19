<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::resource('/categories', CategoryController::class);
Route::resource('/products', ProductController::class);
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index');
    Route::post('/orders/add-order', 'addOrder');
    Route::get('/orders/all-orders', 'allOrders');
    Route::get('/orders/paid', 'orderPaid');
    Route::get('/orders/unpaid', 'orderUnPaid');
    Route::get('/orders/destroy', 'destroy');
});
Route::resource('/customers', CustomerController::class);
