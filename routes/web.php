<?php

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
use App\Product;
use App\Bid;
use App\User;
use \Illuminate\Http\Request;

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'StorefrontController@index');

Route::get('/product/details/{product_id}', 'StorefrontController@details');

Route::get('/product/bid/{product_id}', 'StorefrontController@bid');

Route::post('/product/save_bid', 'StorefrontController@save_bid');

Route::get('/getData', 'AdministrationController@getData');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/products', 'AdministrationController@products_index');
	Route::get('/product/view_product/{product_id}', 'AdministrationController@products_view');
	Route::get('/product/{product_id}', 'AdministrationController@product');
    Route::post('/products/edit_product', 'AdministrationController@products_edit');
    Route::get('/product/delete_product/{product_id}', 'AdministrationController@products_delete');
	Route::get('/getData', 'HomeController@getData');
});

Auth::routes();


