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

Route::get('/site/{pageCode}/{lang}', 'App\Http\Controllers\PageController@page');
Route::post('/site/{pageCode}/{lang}', 'App\Http\Controllers\PageController@order');

Route::resource('/page', 'App\Http\Controllers\PageResController');
