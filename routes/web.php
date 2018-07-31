<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
    //Test
});

$router->group(['middleware' => 'auth', 'namespace' => 'V1'], function () use ($router) {
    $router->get('post', function ()    {
        echo "list post nè";
    });
    $router->post('post', 'PostController@add');
    $router->post('post/{id}', 'PostController@edit');
    $router->delete('post/{id}', 'PostController@delete');
});