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

Route::get('/', 'ApartmentController@index')->name('index');
Route::post('/apartment', 'ApartmentController@store');
Route::get('/apartment/list/', 'ApartmentController@list')->name('list');
Route::post('/apartment/note', 'ApartmentController@storeNote');
Route::post('/apartment/owner', 'ApartmentController@storeOwner');
Route::delete('/apartment/{id}', 'ApartmentController@delete');
Route::get('/apartment/{id}', 'ApartmentController@show')->name('show');

Auth::routes();
