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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('nedmin','Backend\DefaultController@index')->name('nedmin.Index');
Route::get('nedmin/settings','Backend\SettingsController@index')->name('settings.Index');

Route::post('nedmin/sortable','Backend\SettingsController@sortable')->name('settings.Sortable');
