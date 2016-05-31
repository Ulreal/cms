<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'index']);



Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:admin|chat'], function () {
        Route::get('/chat', ['uses' => 'ChatController@index', 'as' => 'chat.index']);
        Route::post('/chat', ['uses' => 'ChatController@create', 'as' => 'chat.add']);
    });

    Route::group(['middleware' => 'role:admin|forum'], function () {
        Route::resource('post', 'PostController');
    });

    Route::group(['middleware' => 'role:admin|news'], function () {
        Route::resource('news','NewsController');
    });
});
