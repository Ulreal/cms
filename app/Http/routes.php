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

/*
 * Route d'authentification et d'inscription
 */
Route::auth();

/*
 * Route de la page d'accueil
 */
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);

/*
 * Route authentifié
 */
Route::group(['middleware' => 'auth'], function () {
    /*
     * Route du chat utilisateur
     */
    Route::group(['middleware' => 'role:admin|chat'], function () {
        Route::get('/chat', ['uses' => 'ChatController@index', 'as' => 'chat.index']);
        Route::post('/chat', ['uses' => 'ChatController@create', 'as' => 'chat.add']);
    });

    /*
     * Route du forum utilisateur
     */
    Route::group(['middleware' => 'role:admin|forum'], function () {
        Route::resource('post', 'PostController');
    });
    Route::group(['middleware' => 'role:admin|forum'], function () {
        Route::resource('comment', 'CommentController');
    });

    /*
     * Route des news utilisateur
     */
    Route::group(['middleware' => 'role:admin|news'], function () {
        Route::resource('news','NewsController');
    });

    /*
     * Route de l'administration
     */
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
        /*
         * Route des configurations
         */
        Route::get('config', ['uses' => 'Administration\ConfigController@index', 'as' => 'admin.config.index']);
        Route::get('config/edit', ['uses' => 'Administration\ConfigController@edit', 'as' => 'admin.config.modify']);
        Route::post('config/{id}/edit', ['uses' => 'Administration\ConfigController@update', 'as' => 'admin.config.update']);
        Route::post('config', ['uses' => 'Administration\ConfigController@create', 'as' => 'admin.config.create']);

        /*
         * Route des news
         */
        Route::get('news', ['uses' => 'Administration\NewsController@index', 'as' => 'admin.news.index']);
        Route::get('news/edit', ['uses' => 'Administration\NewsController@edit', 'as' => 'admin.news.modify']);
        Route::post('news/{id}/edit', ['uses' => 'Administration\NewsController@update', 'as' => 'admin.news.update']);
        Route::post('news', ['uses' => 'Administration\NewsController@create', 'as' => 'admin.news.create']);

        /*
         * Route du forum
         */
        Route::resource('forum', 'Administration\ForumController');

        /*
         * Route de gestion des utilisateurs
         */
        Route::resource('users', 'Administration\UsersController');
    });
});


/*
 * Injection des varriables Config et size_content dans les vues
 */
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