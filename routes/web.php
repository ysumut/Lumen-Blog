<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
});

// API
$router->group(['prefix' => 'api'], function () use ($router) {
    // Auth routes
    $router->post('auth/login', 'AuthController@login');
    $router->post('auth/register', 'AuthController@register');

    // Passport Authentication
    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        // Category
        $router->get('category', 'CategoryController@index');
        // Post
        $router->get('post', 'PostController@index');
        $router->post('post', 'PostController@store');
        $router->put('post/{id}', 'PostController@update');
        $router->delete('post/{id}', 'PostController@destroy');
    });
});
