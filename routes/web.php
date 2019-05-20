<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', [
    'uses' => '\SwaggerLume\Http\Controllers\SwaggerLumeController@api',
]);

$router->get('/version', function () use ($router) {
    return env('APP_NAME') . ' ' . env('APP_VERSION');
});

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router ) {
    $router->post('users', 'App\Http\Controllers\UserController@createUser');
    $router->put('users', 'App\Http\Controllers\UserController@updateUser');
    $router->get('users/{id}', 'App\Http\Controllers\UserController@getUser');
    $router->delete('users/{id}', 'App\Http\Controllers\UserController@deleteUser');

    $router->post('roles', 'App\Http\Controllers\RoleController@createRole');
    $router->put('roles', 'App\Http\Controllers\RoleController@updateRole');
    $router->get('roles/{id}', 'App\Http\Controllers\RoleController@getRole');
    $router->delete('roles/{id}', 'App\Http\Controllers\RoleController@deleteRole');
});
