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
	// post
	$router->group(['prefix' => 'post'], function () use ($router) {
	    $router->post('', 'PostController@add');
	    $router->post('/{id}', 'PostController@edit');
	    $router->delete('/{id}', 'PostController@delete');
	});
	// post meta
	$router->group(['prefix' => 'post-meta'], function () use ($router) {
	    $router->post('', 'PostMetaController@add');
	    $router->post('/{id}', 'PostMetaController@edit');
	    $router->delete('/{id}', 'PostMetaController@delete');
	});
	// taxonomy
	$router->group(['prefix' => 'taxonomy'], function () use ($router) {
	    $router->post('', 'TaxonomyController@add');
	    $router->post('/{id}', 'TaxonomyController@edit');
	    $router->delete('/{id}', 'TaxonomyController@delete');
	});
	// taxonomy relation
	$router->group(['prefix' => 'taxonomy-relation'], function () use ($router) {
	    $router->post('', 'TaxonomyRelationController@add');
	    $router->post('/{id}', 'TaxonomyRelationController@edit');
	    $router->delete('/{id}', 'TaxonomyRelationController@delete');
	});
	// options
	$router->group(['prefix' => 'options'], function () use ($router) {
	    $router->post('', 'OptionsController@add');
	    $router->post('/{id}', 'OptionsController@edit');
	    $router->delete('/{id}', 'OptionsController@delete');
	});
});