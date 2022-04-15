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

Route::post('manager', 'App\Http\Controllers\ManagerController@store');
Route::post('manager/signIn', 'App\Http\Controllers\ManagerController@signIn');
Route::middleware('token')->group(function () {
    Route::post('manager/signOut', 'App\Http\Controllers\ManagerController@signOut');
});
Route::get('menu', 'App\Http\Controllers\MenuController@index');
Route::post('menu/store', 'App\Http\Controllers\MenuController@store');
