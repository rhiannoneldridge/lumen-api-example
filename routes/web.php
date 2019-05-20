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
    $router->get('users', 'App\Http\Controllers\UserController@getAllUsers');
    $router->get('users/{id}', 'App\Http\Controllers\UserController@getUser');
    $router->delete('users/{id}', 'App\Http\Controllers\UserController@deleteUser');

    $router->put('users/{id}/roles', 'App\Http\Controllers\RoleUserController@assignUserRole');
    $router->get('users/{user_id}/roles/{role_id}', 'App\Http\Controllers\RoleUserController@getUserRole');
    $router->get('users/{id}/roles', 'App\Http\Controllers\RoleUserController@getUserRoles');
    $router->delete('users/{user_id}/roles', 'App\Http\Controllers\RoleUserController@removeAllUserRoles');
    $router->delete('users/{user_id}/roles/{role_id}', 'App\Http\Controllers\RoleUserController@removeUserRole');

    $router->post('roles', 'App\Http\Controllers\RoleController@createRole');
    $router->put('roles', 'App\Http\Controllers\RoleController@updateRole');
    $router->get('roles', 'App\Http\Controllers\RoleController@getAllRoles');
    $router->get('roles/{id}', 'App\Http\Controllers\RoleController@getRole');
    $router->delete('roles/{id}', 'App\Http\Controllers\RoleController@deleteRole');
});
