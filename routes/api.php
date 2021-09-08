<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::resource('products','ProductController');
Route::post('/login', 'AuthController@login')->name('api.login');
Route::middleware(['auth:sanctum'])->group(function () {  
	Route::get('/apiProducts','ProductController@index')->name('api.products');
	Route::post('/apiProductsCreate','ProductController@store')->name('api.products.store');
	Route::put('/apiProductsUpdate/{id}','ProductController@update')->name('api.products.update');
	Route::delete('/apiProductsDelete/{id}','ProductController@destroy')->name('api.products.delete');

	Route::get('/apiCategoryList','CategoryController@index')->name('api.category.list');
	Route::post('/apiCategoryCreate','CategoryController@store')->name('api.category.store');
	Route::put('/apiCategoryUpdate/{id}','CategoryController@update')->name('api.category.update');
	Route::delete('/apiCategoryDelete/{id}','CategoryController@destroy')->name('api.category.delete');

	Route::get('/apiProductMasukList','ProductMasukController@index')->name('api.productMasuk.list');
	Route::post('/apiProductMasukListCreate','ProductMasukController@store')->name('api.productMasuk.store');
	Route::put('/apiProductMasukListUpdate/{id}','ProductMasukController@update')->name('api.productMasuk.update');
	Route::get('/apiProductMasukstatusApprove/{id}','ProductMasukController@statusApprove')->name('api.productMasuk.statusApprove');
	Route::delete('/apiProductMasukListDelete/{id}','ProductMasukController@destroy')->name('api.productMasuk.delete');

	Route::get('/apiProductKeluarList','ProductKeluarController@index')->name('api.productKeluar.list');
	Route::post('/apiProductKeluarListCreate','ProductKeluarController@store')->name('api.productKeluar.store');
	Route::put('/apiProductKeluarListUpdate/{id}','ProductKeluarController@update')->name('api.productKeluar.update');
	Route::get('/apiProductKeluarstatusApprove/{id}','ProductKeluarController@statusApprove')->name('api.productKeluar.statusApprove');
	Route::delete('/apiProductKeluarListDelete/{id}','ProductKeluarController@destroy')->name('api.productKeluar.delete');
});
