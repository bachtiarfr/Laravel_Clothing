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

Route::get('/labeled_image/Bachtiar/1.jpg', 'CustomerController@get_labeled_image');
Route::get('/labeled_image/Bachtiar/2.jpg', 'CustomerController@get_labeled_image2');

Route::get('/labeled_image/Fajar/1.jpg', 'CustomerController@get_labeled_fajar');
Route::get('/labeled_image/Fajar/2.jpg', 'CustomerController@get_labeled_fajar2');

Route::get('/labeled_image/Bayu/1.jpg', 'CustomerController@get_labeled_bayu');
Route::get('/labeled_image/Bayu/2.jpg', 'CustomerController@get_labeled_bayu2');


Auth::routes();
Route::group(['middleware' => ['auth']], function () {

    //customers layout
    Route::prefix('Dashboard')->group(function () {
        //products
        Route::resource('/Products', 'Dashboard\ProductController')->middleware('merchants');
        Route::get('/Products/image/{id}', 'Dashboard\ProductController@get_image')->middleware('merchants');
        Route::post('/Products/create', 'Dashboard\ProductController@create')->middleware('merchants');
        Route::post('/Products/add', 'Api\ProductController@store')->middleware('merchants');
        Route::delete('/Products/delete/{id}', 'Api\ProductController@destroy')->middleware('merchants');
        Route::get('/Products/edit/{id}', 'Dashboard\ProductController@edit')->middleware('merchants');
        Route::put('/Products/update/{id}', 'Api\ProductController@update')->middleware('merchants');
        Route::get('/Transaction', 'Dashboard\TController@index')->name('transaction list in dashboard')->middleware('merchants');
        Route::get('/Transaction/ExportPDF', 'Dashboard\TController@exportPDF')->name('export transaction data to pdf')->middleware('merchants');

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

    // SNAP MIDTRANS
    Route::get('/vtweb', 'PagesController@vtweb');
    
    Route::get('/vtdirect', 'PagesController@vtdirect');
    Route::post('/vtdirect', 'PagesController@checkout_process');
    
    Route::get('/vt_transaction', 'PagesController@transaction');
    Route::post('/vt_transaction', 'PagesController@transaction_process');
    
    Route::post('/vt_notif', 'PagesController@notification');
    
    Route::get('/snap', 'SnapController@snap');
    Route::post('/snaptoken', 'SnapController@token');
    Route::post('/snapfinish', 'SnapController@finish');
    


});

// check ongkoskirim
Route::get('/check_ongkir', 'HomeController@getData');
Route::get('/province/{id}/cities', 'HomeController@getCities');
Route::post('/submit_check_ongkir', 'HomeController@submit');