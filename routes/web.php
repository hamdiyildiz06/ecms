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
////    return view('welcome');
//    return view('frontend.default.index');
//});


Route::namespace('Frontend')->group(function () {
    Route::get('/','DefaultController@index')->name('home.Index');

    // Blog
    Route::get('/blog','BlogController@index')->name('blog.Index');
    Route::get('/blog/{slug}','BlogController@detail')->name('blog.Detail');

    // Page
    Route::get('/page/{slug}','PageController@detail')->name('page.Detail');

    // Contact
    Route::get('/contact','DefaultController@contact')->name('contact.Detail');

});

Route::namespace('Backend')->group(function () {

    Route::prefix('nedmin')->group(function () {
        Route::get('/dashboard', 'DefaultController@index')->name('nedmin.Index')->middleware('admin');
        Route::get('/', 'DefaultController@login')->name('nedmin.Login');
        Route::get('/logout', 'DefaultController@logout')->name('nedmin.Logout')->middleware('admin');
        Route::post('/login', 'DefaultController@authenticate')->name('nedmin.Authenticate');
    });


    Route::middleware(['admin'])->group(function () {
        Route::prefix('nedmin/settings')->group(function () {
            Route::get('/', 'SettingsController@index')->name('settings.Index');
            Route::post('', 'SettingsController@sortable')->name('settings.Sortable');
            Route::get('/delete/{id}', 'SettingsController@destroy')->name('settings.Destroy');
            Route::get('/edit/{id}', 'SettingsController@edit')->name('settings.Edit');
            Route::post('update/{id}', 'SettingsController@update')->name('settings.Update');
        });
    });


});

Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {
        Route::middleware(['admin'])->group(function () {

            //Blog
            Route::post('/blog/sortable', 'BlogController@sortable')->name('blog.Sortable');
            Route::resource('blog', 'BlogController');

            //Page
            Route::post('/page/sortable', 'PageController@sortable')->name('page.Sortable');
            Route::resource('page', 'PageController');

            //Slider
            Route::post('/slider/sortable', 'SliderController@sortable')->name('slider.Sortable');
            Route::resource('slider', 'SliderController');

            //User
            Route::post('/user/sortable', 'UserController@sortable')->name('user.Sortable');
            Route::resource('user', 'UserController');
        });
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
