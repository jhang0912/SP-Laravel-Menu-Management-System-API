<?php

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

Route::middleware('jsonRequest')->group(function () {
    Route::post('manager', 'App\Http\Controllers\ManagerController@store');
    Route::post('manager/signIn', 'App\Http\Controllers\ManagerController@signIn');

    Route::middleware('token')->group(function () {
        Route::post('manager/signOut', 'App\Http\Controllers\ManagerController@signOut');
        Route::get('menu', 'App\Http\Controllers\MenuController@index');
        Route::post('menu/store', 'App\Http\Controllers\MenuController@store');
        Route::post('menu/update', 'App\Http\Controllers\MenuController@update');
        Route::post('menu/destory', 'App\Http\Controllers\MenuController@destory');
    });

    Route::fallback('App\Http\Controllers\ErrorHandleController@NotFound');
});

