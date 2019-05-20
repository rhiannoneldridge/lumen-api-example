<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', [
    'uses' => '\SwaggerLume\Http\Controllers\SwaggerLumeController@api',
]);

$router->get('/version', function () use ($router) {
    return env('APP_NAME') . ' ' . env('APP_VERSION');
});

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router ) {
    $router->post('users', 'UserController@createUser');
    $router->put('users/{id}', 'UserController@updateUser');
    $router->get('users', 'UserController@getAllUsers');
    $router->get('users/{id}', 'UserController@getUser');
    $router->delete('users/{id}', 'UserController@deleteUser');

    $router->put('users/{user_id}/roles/{role_id}', 'RoleUserController@assignUserRole');
    $router->put('users/{id}/roles', 'RoleUserController@assignUserRoles');
    $router->get('users/{user_id}/roles/{role_id}', 'RoleUserController@getUserRole');
    $router->get('users/{id}/roles', 'RoleUserController@getUserRoles');
    $router->delete('users/{user_id}/roles', 'RoleUserController@removeAllUserRoles');
    $router->delete('users/{user_id}/roles/{role_id}', 'RoleUserController@removeUserRole');

    $router->post('roles', 'RoleController@createRole');
    $router->put('roles/{id}', 'RoleController@updateRole');
    $router->get('roles', 'RoleController@getAllRoles');
    $router->get('roles/{id}', 'RoleController@getRole');
    $router->delete('roles/{id}', 'RoleController@deleteRole');
});
