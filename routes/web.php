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


Route::get('/', 'InventoryController@index')->name('index');

Route::group(['prefix' => 'categories'], function () {
    Route::get('/','CategoryController@getAll');
    Route::post('/','CategoryController@store');
    Route::get('/{category}','CategoryController@get');
    Route::put('/{category}','CategoryController@update');
    Route::put('/{category}/items','CategoryController@getItems');
});

Route::group(['prefix' => 'items'], function () {
    Route::post('/','ItemController@store');
    Route::get('/{item}','InventoryController@showItem');
    Route::put('/{item}','ItemController@update');

    Route::get('/{item}/stock/{status}','ItemStockController@getWithStock');
    Route::post('/{item}/stock','ItemStockController@store');
    Route::post('/{item}/layaway','ItemStockController@layAway');

    Route::get('/{item}/comments','CommentController@getAll');
    Route::post('/{item}/comments','CommentController@store');
    Route::put('/{item}/comments/{comment}','CommentController@update');
});