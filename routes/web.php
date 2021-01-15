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

Route::namespace('Backend')->group(function (){
    Route::prefix('nedmin/settings')->group(function (){
        Route::get('/','SettingsController@index')->name('settings.Index');
        Route::post('','SettingsController@sortable')->name('settings.Sortable');
        Route::get('/delete/{id}','SettingsController@destroy')->name('settings.Destroy');
        Route::get('/edit/{id}','SettingsController@edit')->name('settings.Edit');
        Route::post('update/{id}','SettingsController@update')->name('settings.Update');
    });
});

Route::namespace('Backend')->group(function (){
    Route::prefix('nedmin')->group(function (){
        Route::post('sortable','BlogController@sortable')->name('blog.Sortable');
        Route::resource('blog','BlogController');
    });
});




