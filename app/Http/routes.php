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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');



Route::group(['middleware' => 'auth'], function () {
    //Chat
    Route::get('/chat', ['uses' => 'ChatController@index', 'as' => 'chat.index']);
    Route::post('/chat', ['uses' => 'ChatController@create', 'as' => 'chat.add']);

    //Post
    Route::get('/post', ['uses' => 'PostController@index', 'as' => 'post.index']);
    Route::post('/post', ['uses' => 'PostController@create', 'as' => 'post.add']);
    Route::get('/post/create', ['uses' => 'PostController@createForm', 'as' => 'post.create']);
    Route::get('/post/{id}/delete', ['uses' => 'PostController@delete', 'as' => 'post.delete']);
    Route::get('/post/{id}/edit', ['uses' => 'PostController@edit', 'as' => 'post.edit']);
    Route::get('/post/{id}/view', ['uses' => 'PostController@view', 'as' => 'post.view']);
});
