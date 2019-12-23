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

Auth::routes();
Route::get('/auth/redirect/{provider}', 'SocialController@redirect')->name('Socialite.redirect');
Route::get('/callback/{provider}', 'SocialController@callback')->name('Socialite.callback');

// Route admin group
Route::prefix('admin')->group(function() {
    Route::resource('articles', 'ArticleController');
    Route::resource('categories', 'CategoryController');
    Route::resource('user', 'UserController', [
        'names' => 'admin.user'
    ])->except('show');
});
Route::resource('user', 'UserIndividuController', [
    "names" => 'user'
])->only('show','edit','update');
Route::get('/{category}', 'Front\ArticleController@category')->name('article.category');
Route::get('/{category}/{slug}', 'Front\ArticleController@show')->name('article.show');



Route::get('/', 'HomeController@index')->name('home');
