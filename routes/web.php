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

// Route::get('/admin', function() {
//     return view('admin');
// });

// Route::prefix('admin', function() {
//     Route::resource('articles', 'ArticleController');
// });

Route::get('admin', function() {
    return view('admin_template');
});

// Route admin group
Route::prefix('admin')->group(function() {
    Route::resource('articles', 'ArticleController');
    Route::resource('categories', 'CategoryController');
    Route::resource('user', 'UserController', [
        'names' => 'admin.user'
    ]);
});
Route::get('/auth/redirect/{provider}', 'SocialController@redirect')->name('Socialite.redirect');
Route::get('/callback/{provider}', 'SocialController@callback')->name('Socialite.callback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
