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

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', [
    'uses' => '\SwaggerLume\Http\Controllers\SwaggerLumeController@api',
]);

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello-world', function () {
    info("Hello World!");

    return response("Hello World!", 200);
});

$router->group(['prefix' => 'api'], function () use ($router ) {
    $router->group(['prefix' => 'users', 'namespace' => 'Users'], function () use ($router) {

    });

    $router->group(['prefix' => 'roles', 'namespace' => 'Roles'], function () use ($router) {

    });
});
