<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', [
    'uses' => '\SwaggerLume\Http\Controllers\SwaggerLumeController@api',
]);

$router->get('/version', function () use ($router) {
    return env('APP_NAME') . ' ' . env('APP_VERSION');
});

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router ) {
    $router->group(['prefix' => 'users', 'namespace' => 'Users'], function () use ($router) {

    });

    $router->group(['prefix' => 'roles', 'namespace' => 'Roles'], function () use ($router) {

    });
});
