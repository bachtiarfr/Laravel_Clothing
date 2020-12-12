<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/Products', 'Api\ProductController', [
    'except' => ['create', 'edit']
]);
Route::resource('/Categorie', 'Api\CategorieController', [
    'except' => ['create', 'edit']
]);
Route::resource('/Cart', 'Api\CartController');

Route::get('/xendit/va/list', 'Api\Payment\XenditController@getListVirtualAccounts');