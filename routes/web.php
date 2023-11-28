<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
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


Route::get('/', function () {
    return view('auth.login');
});
// Auth::routes();
Auth::routes(['register'=>false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('PriceList', PriceListController::class);

Route::post('ajax_products', [ SalesOrderController::class,'ajax_products']);
Route::post('ajax_priceListData', [SalesOrderController::class, 'priceListData']);


Route::resource('salesOrders', SalesOrderController::class);




