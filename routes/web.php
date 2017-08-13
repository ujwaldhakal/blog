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

Route::get('/', function () {
    return view('welcome');
});

Route::get('api','TestController@index');

Route::get('rack','RackspaceController@index');
Route::get('ai','AiController@index');

Route::get('native','NativeController@index');
Route::get('verify','NativeController@verify');
Route::get('add-sites','NativeController@addSites');
Route::get('add-sitesmaps','NativeController@addSiteMaps');
Route::get('list-sites','NativeController@listSites');
Route::get('list-sitesmaps','NativeController@listSiteMaps');
Route::get('token','NativeController@getToken');
Route::get('analytics','NativeController@analytics');
