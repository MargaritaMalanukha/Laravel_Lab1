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
Route::get('/page/create/alias', 'App\Http\Controllers\PageController@createAlias');
Route::post('/site', 'App\Http\Controllers\LangController@changeLang');

Route::resource('/custom_fields', 'App\Http\Controllers\CustomFieldController');
Route::resource('/entity', 'App\Http\Controllers\EntitieController');
Route::post('/page/create/custom_fields', 'App\Http\Controllers\PageController@createWithCustomFields');
