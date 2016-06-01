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

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
        Route::get('config', ['uses' => 'Administration\ConfigController@index', 'as' => 'admin.config.index']);
        Route::get('config/edit', ['uses' => 'Administration\ConfigController@edit', 'as' => 'admin.config.modify']);
        Route::post('config/{id}/edit', ['uses' => 'Administration\ConfigController@update', 'as' => 'admin.config.update']);
        Route::post('config', ['uses' => 'Administration\ConfigController@create', 'as' => 'admin.config.create']);

        Route::resource('forum', 'Administration\ForumController');
    });
});

View::composer('*', function($view)
{
    $tmp = [];
    foreach (\App\Config::all() as $row) {
        $tmp[$row->key] = $row->value;
    }

    $view->with('Config', $tmp);

    $result = 6;
    if ($tmp['menu_gauche'] != 'true')
        $result += 3;
    if ($tmp['menu_droite'] != 'true')
        $result += 3;
    $view->with('size_content', $result);
});