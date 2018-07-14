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

Route::get('/', 'ApartmentController@index');
Route::post('/apartment', 'ApartmentController@store')->middleware('check.role');
Route::get('/apartment/list/', 'ApartmentController@list');
Route::patch('/apartment/status/', 'ApartmentController@updateStatus')->middleware('check.role');
Route::delete('/apartment/{id}', 'ApartmentController@destroy')->middleware('check.role');


Route::post('/note', 'NoteController@store')->middleware('check.role');
Route::delete('/note/{id}', 'NoteController@destroy')->middleware('check.role');

Route::post('/owner', 'OwnerController@store')->middleware('check.role');
Route::delete('/owner/{id}', 'OwnerController@destroy')->middleware('check.role');

Auth::routes();
