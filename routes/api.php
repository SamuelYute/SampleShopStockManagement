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


Route::group([], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/','CategoryController@getAll');
        Route::post('/','CategoryController@store');
        Route::get('/{category}','CategoryController@get');
        Route::put('/{category}','CategoryController@update');
        Route::get('/{category}/items','CategoryController@getItems');
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('/','ItemController@getAll');
        Route::post('/','ItemController@store');
        Route::put('/{item}','ItemController@update');

        Route::get('/{item}/stock/{status}','ItemStockController@getWithStock');
        Route::post('/{item}/stock','ItemStockController@store');
        Route::post('/{item}/layaway','ItemStockController@layAway');

        Route::get('/{item}/comments','CommentController@getAll');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/','CommentController@store');
        Route::put('/{comment}','CommentController@update');
    });
});

