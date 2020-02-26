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

Route::get('/', 'CustomerController@index');
Route::get('/products', 'CustomerController@product');
Route::get('/myvoucher', 'CustomerController@myVoucher');
Route::get('/home', 'CustomerController@index');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {

    //customers layout
    Route::prefix('Dashboard')->group(function () {

        //products
        Route::resource('/Products', 'Dashboard\ProductController')->middleware('merchants');
        Route::post('/Products/create', 'Dashboard\ProductController@create')->middleware('merchants');
        Route::post('/Products/add', 'Api\ProductController@store')->middleware('merchants');
        Route::delete('/Products/delete/{id}', 'Api\ProductController@destroy')->middleware('merchants');
        Route::get('/Products/edit/{id}', 'Dashboard\ProductController@edit')->middleware('merchants');
        Route::put('/Products/update/{id}', 'Api\ProductController@update')->middleware('merchants');
        Route::get('/Transaction', 'Dashboard\TController@index')->name('transaction list in dashboard')->middleware('merchants');

        //categorie
        Route::resource('/Categories', 'Dashboard\CategorieController')->middleware('merchants');
        Route::post('/Categories/create', 'Dashboard\CategorieController@create')->middleware('merchants');
        Route::post('/Categories/add', 'Dashboard\CategorieController@store')->middleware('merchants');
        Route::delete('/Categories/delete/{id}', 'Dashboard\CategorieController@destroy')->middleware('merchants');
        Route::get('/Categories/edit/{id}', 'Dashboard\CategorieController@edit')->middleware('merchants');
        Route::put('/Categories/update/{id}', 'Dashboard\CategorieController@update')->middleware('merchants');
        // Route::resource('/Rewards', 'ProductController')->name('reward list in dashboard');
    });

    //cart 
    Route::get('/cart', 'CartController@show')->middleware('customers');
    Route::get('/cart/customers', 'CartController@index')->middleware('customers');
    Route::post('/cart/add', 'CartController@store')->name('add_to_cart');
    Route::delete('/cart/delete/{id}', 'CartController@destroy')->name('delete_cart');

    //chechkout
    Route::get('/checkout', 'CustomerController@checkout');
    Route::resource('/checkout/transaction', 'CheckoutController');

    //trade point with voucher
    Route::post('/voucher/add', 'CustomerController@addVoucher');
});
